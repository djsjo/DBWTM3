<!-- View Start -->
<div class="row">
	<div class="col">
		<h2>{{ $headline }}</h2>
		<p>Einfache Iteration durch ein Array. So könnten Sie auch verschachtelte Arrays durchgehen (weitere <code>@@foreach</code>-Anweisungen)</p>

		<dl>
		@foreach($defs as $def)
			<dt>{{ $def["label"] }}</dt>
			<dd>{{ $def["term"] }}</dd>
		@endforeach
		</dl>
	</div>
</div>
<!-- View End -->