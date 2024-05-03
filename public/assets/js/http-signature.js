function CreateRequestSignature(method, uri, httpHeaders, signedHeaderNames, keyId, hexaHmacKey) {
    var created = Math.floor(new Date().getTime() / 1000);
    var lowercaseHeaders = {};
    for (var key in httpHeaders) {
        if (httpHeaders.hasOwnProperty(key)) {
            lowercaseHeaders[key.toLowerCase()] = httpHeaders[key];
        }
    }
    lowercaseHeaders["(request-target)"] = method.toLowerCase() + " " + uri;
    lowercaseHeaders["(created)"] = created;

    var signingString = "";

    var headerNames = "";
    for (var i = 0; i < signedHeaderNames.length; i++) {
        var headerName = signedHeaderNames[i];
        if (!lowercaseHeaders.hasOwnProperty(headerName)) {
            throw "MissingRequiredHeaderException: " + headerName;
        }
        if (signingString !== "") signingString += "\n";
        signingString += headerName + ": " + lowercaseHeaders[headerName];

        if (headerNames !== "") headerNames += " ";
        headerNames += headerName;
    }

    console.log("signingString=" + signingString);

    var hmacKey = CryptoJS.enc.Hex.parse(hexaHmacKey);
    var signature = CryptoJS.enc.Base64.stringify(CryptoJS.HmacSHA512(signingString, hmacKey));
    var signingAlgorithm = "hs2019";
    return "algorithm=\"" + signingAlgorithm + "\"" +
        ", keyId=\"" + keyId + "\"" +
        ", headers=\"" + headerNames + "\"" +
        ", created=" + created +
        ", signature=\"" + signature + "\"";
}