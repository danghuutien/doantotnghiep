@if (isset($data) && count($data) > 0)
	@foreach ($data as $item)
	<div 
		class="item"
		data-id="{{$item->id}}"
		data-url="{{$item->getUrl()}}"
		data-image="{{$item->getImage('')}}"
		data-name="{{$item->name}}"
		data-size="{{$item->getSize()}}"
		data-created="{{$item->getCreatedAt()}}"
		data-updated="{{$item->getUpdatedAt()}}"
		data-title="{{$item->getTitle()}}"
		data-caption="{{$item->getCaption()}}"
	>
		<div class="item-image">
			<img src="{{$item->getImage()}}" alt="">
		</div>
		<div class="item-info">
			<p class="item-info__name">{{$item->name}}</p>
			<p class="item-info__size">{!!trans('Translate::media.text_size')!!}: {{$item->getSize()}}</p>
			<p class="item-info__created">{!!trans('Translate::media.text_created')!!}: {{$item->getCreatedAt()}}</p>
			<p class="item-info__updated">{!!trans('Translate::media.text_updated')!!}: {{$item->getUpdatedAt()}}</p>
			@if ($item->getTitle() != '')
			<p class="item-info__title">{!!trans('Translate::media.text_title')!!}: {{$item->getTitle()}}</p>
			@endif
			@if ($item->getCaption() != '')
			<p class="item-info__caption">{!!trans('Translate::media.text_desc')!!}: {{$item->getCaption()}}</p>
			@endif
		</div>
	</div>
	@endforeach
@else
	<div class="media-content__main-list__upload">
		<i class="fa fa-cloud-upload icon"></i>
		<label for="file" class="inputfile" files selected">
			{!!trans('Translate::media.no_image')!!}
		</label>
	</div>
@endif