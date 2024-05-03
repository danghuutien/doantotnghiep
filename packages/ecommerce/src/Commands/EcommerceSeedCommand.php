<?php

namespace Sudo\Ecommerce\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;

class EcommerceSeedCommand extends Command {

    protected $signature = 'sudo/product:seeds';

    protected $description = 'Khởi tạo dữ liệu tỉnh thành cho module sản phẩm';

    public function handle() {
    	DB::table('products')->truncate();
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $detail = '<div class="tubo-media-item"><img style="display: block; margin-left: auto; margin-right: auto;" src="https://example.sudospaces.com/toshiko/2022/12/bitmap24.png" alt="" /></div>
<p><strong> Mô tả sản phẩm</strong></p>
<p>Ghế massage toàn thân ngày nay là sản phẩm được nhiều người, nhiều gia đình lựa chọn bởi nhiều lợi ích bất ngờ cho sức khỏe người dùng mà nó mang lại. Qua nhiều nghiên cứu và cải tiến, ghế massage Toshiko T21 hội tụ mọi tính năng ưu việt, đáp ứng tốt hơn nhu cầu được chăm sóc của người sử dụng.</p>
<div class="tubo-media-item"><img style="display: block; margin-left: auto; margin-right: auto;" src="https://example.sudospaces.com/toshiko/2022/12/bitmap21.png" alt="" /></div>
<p> </p>
<p>Ghế massage toàn thân ngày nay là sản phẩm được nhiều người, nhiều gia đình lựa chọn bởi nhiều lợi ích bất ngờ cho sức khỏe người dùng mà nó mang lại. Qua nhiều nghiên cứu và cải tiến, ghế massage Toshiko T21 hội tụ mọi tính năng ưu việt, đáp ứng tốt hơn nhu cầu được chăm sóc của người sử dụng.</p>
<p>Ghế massage Toshiko T21 là một trong những thiết bị hàng đầu chăm sóc sức khỏe tại nhà. Hầu hết những người trải nghiệm thử qua chiếc ghế TOSHIKO đều rất ưng ý bởi khả năng massage chính xác huyệt đạo, hỗ trợ giảm thiểu nhanh chóng các vùng đau nhức trên cơ thể.</p>
<section id="tab1" class="bx-content-review left100">
<div class="bx-header-news-related left100">
<h2 id="mcetoc_1gkkl7foc0">Mô tả sản phẩm</h2>
</div>
<div class="main-content left100">
<p><strong><span class="clrTit bld" style="font-size: 12pt;">Cuộc sống hiện đại nhiều căng thẳng, mệt mỏi nhưng chúng ta lại quá bận rộn, không có nhiều thời gian cho việc nghỉ ngơi cũng như đến các trung tâm thư giãn. Chính vì thế mà nhiều người lựa chọn tận dụng tối đa thời gian chăm sóc sức khỏe toàn diện với ghế massage ngay tại nhà. Nếu bạn còn đang lo lắng về giá cả thì hãy tìm hiểu ngay dòng ghế massage Toshiko T6, chỉ chưa đến 20 triệu nhưng Toshiko T6 trang bị đầy đủ tính năng của một chiếc ghế massage hiện đại, thông minh.</span></strong></p>
<p>Sau thời gian dài nghiên cứu, mới đây Toshiko đã cho ra mắt dòng ghế Ghế massage Toshiko T6 chiều lòng được rất nhiều các khách hàng vì Toshiko T6 không chỉ có hình thức bắt mắt mà còn đáp ứng được nhu cầu thư giãn, chăm sóc sức khỏe của cả gia đình, đặc biệt nhất là giá cả phải chăng. Rất khó để tìm được một chiếc <span style="color: #ff0000;"><strong><a style="color: #ff0000;" href="https://toshiko.vn/">ghế massage</a></strong> </span>cùng phân khúc trên thị trường mà chất lượng tốt như vậy, trang bị đầy đủ từ <strong><span style="color: #ff0000;"><a style="color: #ff0000;" href="https://toshiko.vn/co-gi-dac-biet-trong-cac-mau-ghe-massage-khong-trong-luc/">tính năng không trọng lực</a></span></strong>, nhiệt hồng ngoại, nghe nhạc bluetooth hay đa dạng các bài massage cho toàn thân hay từng bộ phận.</p>
<p><img class=" wp-image-14145 aligncenter" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2022/07/DSC09672-300x200.jpg" sizes="(max-width: 895px) 100vw, 895px" srcset="https://toshiko.vn/wp-content/uploads/2022/07/DSC09672-300x200.jpg 300w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09672-1024x683.jpg 1024w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09672-768x512.jpg 768w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09672-1536x1025.jpg 1536w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09672-2048x1366.jpg 2048w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09672-600x400.jpg 600w" alt="" width="895" height="596" /></p>
</div>
</section>
<section id="tab2" class="bx-content-review left100">
<div class="bx-header-news-related left100">
<h2 id="mcetoc_1gkkl7foc1">Tính năng</h2>
</div>
<div class="main-content left100">
<p><strong>GHẾ MASSAGE TOSHIKO T6 – SẢN PHẨM TÍCH HỢP MỌI ƯU ĐIỂM VƯỢT TRỘI</strong></p>
<ul style="list-style-type: square;">
<li>
<div id="FRAME5477" class="ladi-element">
<div class="ladi-frame">
<div id="PARAGRAPH5478" class="ladi-element">
<p class="ladi-paragraph"><strong>Công nghệ túi khí từ đầu đến chân</strong></p>
</div>
</div>
</div>
</li>
</ul>
<div id="PARAGRAPH5306" class="ladi-element">
<p class="ladi-paragraph">Tích hợp hoàn hảo hệ thống túi khí massage tại nhiều vùng trên cơ thể như đầu, vai gáy, hông, cánh tay, bắp chân. Các túi khí lớn nhỏ luân phiên bóp nhả nhịp nhàng giúp làm mềm cơ, hỗ trợ giảm căng cứng cơ, phù nề. Có thể tắt/bật, điều chỉnh độ mạnh của túi khi theo mong muốn của người dùng.</p>
</div>
<div id="IMAGE5308" class="ladi-element">
<div class="ladi-image">
<p><img class=" wp-image-14357 aligncenter" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2022/07/DSC03398-300x200.jpg" sizes="(max-width: 830px) 100vw, 830px" srcset="https://toshiko.vn/wp-content/uploads/2022/07/DSC03398-300x200.jpg 300w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03398-1024x683.jpg 1024w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03398-768x512.jpg 768w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03398-1536x1025.jpg 1536w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03398-2048x1366.jpg 2048w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03398-600x400.jpg 600w" alt="" width="830" height="553" /></p>
</div>
</div>
<ul style="list-style-type: square;">
<li>
<div id="FRAME5481" class="ladi-element">
<div class="ladi-frame">
<div id="PARAGRAPH5482" class="ladi-element">
<p class="ladi-paragraph"><strong>Con lăn 3D</strong></p>
</div>
</div>
</div>
</li>
</ul>
<div id="PARAGRAPH5367" class="ladi-element">
<p class="ladi-paragraph">Hệ thống con lăn 3D bám sát cột sống với các kỹ thuật massage chân thực như bàn tay con người, con lăn sẽ tác động theo ba chiều: dài, rộng, sâu và di chuyển lên xuống cùng thao tác xoay tròn, tạo ra các thao tác xoa, miết và day ấn tại chỗ giúp thư giãn, hỗ trợ làm giảm đau nhức hiệu quả.</p>
</div>
<div id="FRAME5453" class="ladi-element">
<div class="ladi-frame">
<p><img class="wp-image-3670 aligncenter" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2021/07/Capture.jpg" sizes="(max-width: 724px) 100vw, 724px" srcset="https://toshiko.vn/wp-content/uploads/2021/07/Capture.jpg 803w, https://toshiko.vn/wp-content/uploads/2021/07/Capture-300x210.jpg 300w, https://toshiko.vn/wp-content/uploads/2021/07/Capture-768x538.jpg 768w, https://toshiko.vn/wp-content/uploads/2021/07/Capture-600x420.jpg 600w" alt="massage 3d" width="724" height="507" /></p>
</div>
</div>
<ul style="list-style-type: square;">
<li>
<div id="FRAME5485" class="ladi-element">
<div class="ladi-frame">
<div id="PARAGRAPH5486" class="ladi-element">
<p class="ladi-paragraph"><strong>Chức năng massage không trọng lực </strong></p>
</div>
</div>
</div>
</li>
</ul>
<div id="PARAGRAPH5310" class="ladi-element">
<p class="ladi-paragraph">Với phương pháp massage không trọng lực ở vị trí trọng số bằng không, phần ghế ngã về sau xuống 170 độ, ở vị trí của massage không trọng lực các con lăn massage có tiếp xúc tốt hơn với khu vực thắt lưng, đảm bảo rằng toàn bộ cơ thể tận hưởng một massage hiệu quả.</p>
</div>
<div id="IMAGE5313" class="ladi-element">
<div class="ladi-image"><img class=" wp-image-14141 aligncenter" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2022/07/DSC09618-300x240.jpg" sizes="(max-width: 882px) 100vw, 882px" srcset="https://toshiko.vn/wp-content/uploads/2022/07/DSC09618-300x240.jpg 300w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09618-1024x820.jpg 1024w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09618-768x615.jpg 768w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09618-1536x1230.jpg 1536w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09618-2048x1640.jpg 2048w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09618-600x480.jpg 600w" alt="" width="882" height="706" /></div>
</div>
<ul style="list-style-type: square;">
<li>
<div id="FRAME5489" class="ladi-element">
<div class="ladi-frame">
<div id="PARAGRAPH5490" class="ladi-element">
<p class="ladi-paragraph"><strong>Massage nhiệt hồng ngoại</strong></p>
</div>
</div>
</div>
</li>
</ul>
<div id="PARAGRAPH5329" class="ladi-element">
<p class="ladi-paragraph">Nhiệt nóng hồng ngoại vùng lưng và bắp chân tạo ra lượng nhiệt vừa đủ để làm ấm cơ thể, kích thích lưu thông, hỗ trợ tăng tuần hoàn máu, giúp giải phóng cơ căng cứng, giảm đau nhức nhanh chóng. Đối với một số chấn thương liên quan đến xương, nhiệt nóng hồng ngoại còn có thể giúp mau lành vết thương, rút ngắn thời gian phục hồi.</p>
</div>
<div id="IMAGE5330" class="ladi-element">
<div class="ladi-image"><img class="aligncenter wp-image-3672" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2021/07/Capture-1.jpg" sizes="(max-width: 734px) 100vw, 734px" srcset="https://toshiko.vn/wp-content/uploads/2021/07/Capture-1.jpg 806w, https://toshiko.vn/wp-content/uploads/2021/07/Capture-1-300x222.jpg 300w, https://toshiko.vn/wp-content/uploads/2021/07/Capture-1-768x568.jpg 768w, https://toshiko.vn/wp-content/uploads/2021/07/Capture-1-600x444.jpg 600w" alt="" width="734" height="543" /></div>
</div>
<ul style="list-style-type: square;">
<li>
<div id="FRAME5493" class="ladi-element">
<div class="ladi-frame">
<div id="PARAGRAPH5494" class="ladi-element">
<p class="ladi-paragraph"><strong>Đa dạng các bài massage</strong></p>
</div>
</div>
</div>
</li>
</ul>
<div id="PARAGRAPH5316" class="ladi-element">
<div id="PARAGRAPH5315" class="ladi-element">
<p class="ladi-paragraph">► Massage tự động</p>
</div>
<p class="ladi-paragraph">Khả năng massage tự động toàn thân với tất cả các chức năng trong khoảng thời gian 15 phút. Nhanh chóng phục hồi sức khỏe, thư giãn, giảm nhức mỏi cơ thể. Các kỹ thuật massage được mô phỏng tự nhiên như bàn tay con người: Miết, day, ấn huyệt, bóp đẩy… Tác dụng của ghế massage giống như việc bạn tập yoga hay chạy bộ vậy, sẽ giúp bạn điều hòa nhịp tim tốt hơn.</p>
</div>
<p><img class="aligncenter wp-image-3673" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2021/07/Capture-2.jpg" sizes="(max-width: 714px) 100vw, 714px" srcset="https://toshiko.vn/wp-content/uploads/2021/07/Capture-2.jpg 629w, https://toshiko.vn/wp-content/uploads/2021/07/Capture-2-274x300.jpg 274w, https://toshiko.vn/wp-content/uploads/2021/07/Capture-2-600x657.jpg 600w" alt="" width="714" height="782" data-wp-editing="1" /></p>
<div id="PARAGRAPH5319" class="ladi-element">
<p class="ladi-paragraph">►Massage vùng riêng biệt</p>
</div>
<div id="IMAGE5320" class="ladi-element">
<div class="ladi-image">
<div id="PARAGRAPH5318" class="ladi-element">
<p class="ladi-paragraph">Ghế massage hiện đại nằm ở việc massage theo nhu cầu của từng người, như là khả năng điều chỉnh riêng biệt các vùng massage theo ý muốn người sử dụng như vùng đầu, vùng vai gáy, vùng chân, vùng thắt lưng,…</p>
<p><img class="aligncenter size-full wp-image-3674" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2021/07/z2585899213729_88829f244e1552104837d0ce92efba11.jpg" sizes="(max-width: 707px) 100vw, 707px" srcset="https://toshiko.vn/wp-content/uploads/2021/07/z2585899213729_88829f244e1552104837d0ce92efba11.jpg 707w, https://toshiko.vn/wp-content/uploads/2021/07/z2585899213729_88829f244e1552104837d0ce92efba11-300x296.jpg 300w, https://toshiko.vn/wp-content/uploads/2021/07/z2585899213729_88829f244e1552104837d0ce92efba11-600x592.jpg 600w, https://toshiko.vn/wp-content/uploads/2021/07/z2585899213729_88829f244e1552104837d0ce92efba11-100x100.jpg 100w" alt="" width="707" height="697" /></p>
</div>
</div>
</div>
<ul style="list-style-type: square;">
<li><strong>Bảng điều khiển cảm ứng</strong></li>
</ul>
<div id="PARAGRAPH5335" class="ladi-element">
<p class="ladi-paragraph">Ghế massage TOSHIKO có thiết kế bảng điều khiển cảm ứng, chi tiết kí hiệu dễ sử dụng, phù hợp cho cả người lớn tuổi. Có thể điều chỉnh thời gian, cấp độ massage, tuỳ chỉ góc và thay đổi nhiều tư thế theo người sử dụng.</p>
</div>
<p><img class=" wp-image-14152 aligncenter" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2022/07/DSC09729-300x200.jpg" sizes="(max-width: 872px) 100vw, 872px" srcset="https://toshiko.vn/wp-content/uploads/2022/07/DSC09729-300x200.jpg 300w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09729-1024x683.jpg 1024w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09729-768x512.jpg 768w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09729-1536x1025.jpg 1536w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09729-2048x1366.jpg 2048w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09729-600x400.jpg 600w" alt="" width="872" height="582" /></p>
<ul style="list-style-type: square;">
<li>
<div id="FRAME5453" class="ladi-element">
<div class="ladi-frame">
<div id="PARAGRAPH5455" class="ladi-element">
<p class="ladi-paragraph"><strong>Nghe nhạc kết nối Bluetooth</strong></p>
</div>
</div>
</div>
</li>
</ul>
<div id="PARAGRAPH5337" class="ladi-element">
<p class="ladi-paragraph">Thiết kế sáng tạo, khoa học với hệ thống âm thanh Bluetooth không dây kết nối với điện thoại, máy tính bảng giúp bạn vừa massage vừa có thể nghe nhạc yêu thích giúp tinh thần thoải mái, yêu đời hơn. Ghế massage Toshiko là lựa chọn phù hợp cho những người bị chứng mất ngủ, giúp cải thiện chất lượng giấc ngủ tốt hơn.</p>
</div>
<div id="BUTTON5340" class="ladi-element" data-acti="">
<div class="ladi-button"><img class=" wp-image-14159 aligncenter" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2022/07/DSC09758-300x200.jpg" sizes="(max-width: 889px) 100vw, 889px" srcset="https://toshiko.vn/wp-content/uploads/2022/07/DSC09758-300x200.jpg 300w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09758-1024x683.jpg 1024w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09758-768x512.jpg 768w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09758-1536x1025.jpg 1536w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09758-2048x1366.jpg 2048w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09758-600x400.jpg 600w" alt="" width="889" height="593" /></div>
</div>
</div>
</section>
<section id="tab3" class="bx-content-review left100">
<div class="bx-header-news-related left100">
<h2 id="mcetoc_1gkkl7foc2">Lợi ích</h2>
</div>
<div class="main-content left100">
<p><strong>Tác dụng tuyệt vời của massage nói chung và ghế massage nói riêng đối với sức khỏe:</strong></p>
<div>
<div>
<h3 id="mcetoc_1gkkl7foc3"><span style="font-size: 12pt;"><strong>1. Hỗ trợ giảm căng thẳng, căng thẳng và lo lắng</strong></span></h3>
<div>Nhiều nghiên cứu đã chỉ ra rằng liệu pháp xoa bóp làm giảm bớt các triệu chứng căng thẳng cả về thể chất và tâm lý. Các chỉ số về mức tiêu thụ oxy, huyết áp và mức hoocmon cortisol đều thấp hơn sau khi massage từ 10 đến 15 phút.</div>
<div>
<h3 id="mcetoc_1gkkl7foc4"><span style="font-size: 12pt;"><strong>2. Thư giãn và hỗ trợ giảm bớt các cơn đau</strong></span></h3>
<p>Việc sử dụng ghế massage sau khoảng thời gian phải hoạt động cường độ cao hoặc ngồi quá lâu một chỗ hàng giờ đồng hồ sẽ giúp người dùng tăng sức bền của cơ, đồng thời sẽ hỗ trợ làm giảm những triệu chứng co cứng, phù nề, đau khớp, mỏi cơ, thư giãn và nới lỏng cơ bắp,… Bên cạnh đó, massage thường xuyên còn giúp chống teo cơ, tích lũy glycogen giúp cơ mau phục hồi và phát triển tốt hơn. Sử dụng ghế mát xa đã được chứng minh về hiệu quả hỗ trợ làm giảm các chứng bệnh như: nhức đầu, đau mỏi cơ, đau cổ / vai / lưng.</p>
<h3 id="mcetoc_1gkkl7foc5"><span style="font-size: 12pt;"><strong>3. Hỗ trợ cải thiện lưu lượng máu</strong></span></h3>
<div>Các kỹ thuật massage bao gồm đấm, vỗ, miết, day, ấn được ghế massage được thực hiện bằng hệ thống con lăn di chuyển và rung tới mọi vùng ở phần sau của cơ thể do đó ghế massage giúp hỗ trợ cải thiện, thúc đẩy quá trình lưu thông máu.</div>
</div>
</div>
<div> </div>
<div><img class=" wp-image-14358 aligncenter" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2022/07/DSC03415-300x200.jpg" sizes="(max-width: 901px) 100vw, 901px" srcset="https://toshiko.vn/wp-content/uploads/2022/07/DSC03415-300x200.jpg 300w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03415-1024x683.jpg 1024w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03415-768x512.jpg 768w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03415-1536x1024.jpg 1536w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03415-2048x1366.jpg 2048w, https://toshiko.vn/wp-content/uploads/2022/07/DSC03415-600x400.jpg 600w" alt="" width="901" height="600" /></div>
</div>
<div>
<div>
<div>
<div>
<div>
<h3 id="mcetoc_1gkkl7foc6"><span style="font-size: 12pt;"><strong>4. Hỗ trợ tăng cường hệ miễn dịch</strong></span></h3>
<div>Bạn có biết rằng chỉ cần massage 30 phút/ngày làm tăng số lượng tế bào lympho trong cơ thể? Tế bào lympho là các tế bào bạch cầu giúp bảo vệ cơ thể chống lại bệnh tật, nó chịu trách nhiệm về phản ứng miễn dịch của cơ thể đối với các tác nhân gây hại. Khi cơ thể có thể tăng số lượng tế bào lympho tốt chống lại các chứng bệnh mà chúng ta thường mắc phải như bệnh cảm lạnh, sốt hay cúm.</div>
<div>
<h3 id="mcetoc_1gkkl7foc7"><span style="font-size: 12pt;"><strong>7. Giảm áp lực lên cột sống</strong></span></h3>
<div>Lợi ích sức khoẻ đặc biệt này có thể gặt hái được từ những chiếc ghế mát xa có tính năng Zero Gravity. Bằng cách xoa bóp các vùng cơ, lưu lượng máu được tăng lên, acid lactic được đào thải trong cơ thể một cách tự nhiên mà không cần bác sĩ trị liệu hoặc một nhân viên massage chuyên nghiệp.</div>
<h3 id="mcetoc_1gkkl7foc8"><span style="font-size: 12pt;"><strong>8. Hỗ trợ cải thiện cấu trúc xương sống</strong></span></h3>
<div>Ghế massage hỗ trợ làm tăng tính vận động và làm mềm các vùng cơ bị co cứng, điều chỉnh sự liên kết cột sống và duy trì sự cân bằng máu tới mọi vùng của cơ thể. Cải thiện tình trạng cong vẹo cột sống và cân bằng cấu trúc tổng thể hệ xương khớp là một trong những lợi ích của ghế massage được nhiều người yêu thích.</div>
<div>
<h3 id="mcetoc_1gkkl7foc9"><span style="font-size: 12pt;"><strong>9. Cải thiện và nâng cao chất lượng giấc ngủ</strong></span></h3>
<div>Các nghiên cứu đã cho thấy rằng liệu pháp xoa bóp hỗ trợ giảm mệt mỏi và cải thiện giấc ngủ bao gồm cả nam và nữ, những người trẻ và già, thậm chí những người ốm yếu, người bị các bệnh liên quan đến tim mạch hoặc rối loạn tâm thần.</div>
</div>
</div>
</div>
<div> </div>
<div><img class=" wp-image-14133 aligncenter" style="display: block; margin-left: auto; margin-right: auto;" src="https://toshiko.vn/wp-content/uploads/2022/07/DSC09514-300x200.jpg" sizes="(max-width: 940px) 100vw, 940px" srcset="https://toshiko.vn/wp-content/uploads/2022/07/DSC09514-300x200.jpg 300w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09514-1024x683.jpg 1024w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09514-768x512.jpg 768w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09514-1536x1025.jpg 1536w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09514-2048x1366.jpg 2048w, https://toshiko.vn/wp-content/uploads/2022/07/DSC09514-600x400.jpg 600w" alt="" width="940" height="626" /></div>
<div> </div>
<div> </div>
</div>
</div>
</div>
</div>
</div>
</section>';

        // Bài viết
        $stt = 0;
        for ($j=0; $j < 1; $j++) { 
            $posts = [];
            $seos = [];
            $lang_metas = [];
            for ($i=0; $i < 100; $i++) {
                $stt++;
                $name = 'Ghế massage Toshiko T'.$stt;
                $posts[] = [
                    'name' => $name,
                    'slug' => str_slug($name),
                    'category_id' => rand(1,5),
                    'image' => 'https://example.sudospaces.com/toshiko/2022/12/bitmap20-1.png',
                    'related_products' => '1,2,3,4,5',
                    'detail' => $detail,
                    'specifications' => 'eyJ0aXRsZSI6WyJNb2RlbCIsIktoXHUxZWQxaSBsXHUwMWIwXHUxZWUzbmciLCJIXHUxZWM3IHRoXHUxZWQxbmcgZ2lcdTFlYTNtIHNcdTFlZDFjIiwiS2lcdTFlYzN1IHRoXHUxZWEzbSBjaFx1MWVhMXkiLCJLXHUwMGVkY2ggdGhcdTAxYjBcdTFlZGJjIHNcdTFlZWQgZFx1MWVlNW5nIiwiS1x1MDBlZGNoIHRoXHUwMWIwXHUxZWRiYyB2XHUwMGY5bmcgY2hcdTFlYTF5IiwiS1x1MDBlZGNoIHRoXHUwMWIwXHUxZWRiYyBcdTAxMTFcdTAwZjNuZyB0aFx1MDBmOW5nIiwiS1x1MDBlZGNoIHRoXHUwMWIwXHUxZWRiYyB4XHUxZWJmcCBnXHUxZWNkbiIsIlh1XHUxZWE1dCB4XHUxZWU5IiwiXHUwMTEwaVx1MWVjN24gXHUwMGMxcCIsIlx1MDExMFx1MWVkOW5nIENcdTAxYTEiLCJUXHUxZWEzaSB0clx1MWVjZG5nIHNcdTFlYTNuIHBoXHUxZWE5bSIsIlRcdTFlZDFjIFx1MDExMVx1MWVkOSB0XHUxZWQxaSBcdTAxMTFhIl0sInZhbHVlIjpbIjEyIiwiNzBrZyIsIkxcdTAwZjIgeG8sIFx1MDExMVx1MWVjN20gY2FvIHN1IiwiS2ltIENcdTAxYjBcdTAxYTFuZyIsIjE2MjAqNzgwKjEyNTBtbSIsIjEyNng0MihDbSkgfCAoRHhSKSIsIjE4MzB4NzU1eDMxMG1tIiwiMTE5MCo3ODAqMTI0MG1tIiwiVHJ1bmcgUXVcdTFlZDFjIiwiMjIwViwgNTAtNjBIeiIsIlRpXHUxZWJmdCBLaVx1MWVjN20gXHUwMTEwaVx1MWVjN24gTlx1MDEwM25nIiwiMTEwIEtnIiwiMTQgS21cL2giXX0=',
                    'slide' => 'https://example.sudospaces.com/toshiko/2022/12/bitmap20.png,https://example.sudospaces.com/toshiko/2022/12/bitmap21.png,https://example.sudospaces.com/toshiko/2022/12/bitmap20.png,https://example.sudospaces.com/toshiko/2022/12/bitmap20.png,https://example.sudospaces.com/toshiko/2022/12/bitmap20.png',
                    'price' => '33300000',
                    'price_old' => '66600000',
                    'status' => 1,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ];
                $seos[] = [
                    'type'              => 'products',
                    'type_id'           => $stt+1,
                    'title'             => '',
                    'description'       => '',
                    'robots'            => 'Index,Follow',
                ];
                $lang_metas[] = [
                    'lang_table'        => 'products',
                    'lang_table_id'     => $stt+1,
                    'lang_locale'       => 'vi',
                    'lang_code'         => getCodeLangMeta()
                ];
            }
            DB::table('products')->insert($posts);
            DB::table('seos')->insert($seos);
            DB::table('language_metas')->insert($lang_metas);
        }
        $this->echoLog('Sản phẩm duoc tao thanh cong. So luong: '.$stt);
    }

    public function echoLog($string) {
        $this->info($string);
        Log::info($string);
    }

}