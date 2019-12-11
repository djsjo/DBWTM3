<!-- View Start -->
<div class="row">
	<div class="col">
		<!-- falls $headline nicht an die View übergeben wurde 
			 den Text 'Einfach eine Gallerie' anzeigen -->
		<h2>{{ $headline or 'Einfach eine Gallerie'}}</h2> 
		<ul>
		@for ($i = 0; $i < 3; $i++)
			<li id="pic-{{ $i }}">
				<p> {{$labels[$i]}} </p>	
				<img class="img-fluid" src="{{ $media[$i]}} " alt="{{ $labels[$i]}} " />
			</li>
		@endfor
		</ul>
	</div>
</div>
<!-- View End -->