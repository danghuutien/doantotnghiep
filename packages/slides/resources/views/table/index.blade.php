@include('Table::components.image',['image' => $value->getImage()])
@include('Table::components.link',['text' => $value->title, 'url' => route('admin.slides.edit', $value->id)])
@include('Table::components.edit_text', [ 'width' => '100px', 'name' => 'orders' ])