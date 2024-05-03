@include('Table::components.text',['text' => $value->name])
@include('Table::components.text',['text' => date('H:i:s d-m-Y', strtotime($value->start_time))])
@include('Table::components.text',['text' => date('H:i:s d-m-Y', strtotime($value->end_time))])
