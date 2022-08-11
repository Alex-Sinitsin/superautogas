@props([
'label' => '',
'name' => '',
'placeholder' => '',
'required' => false
])
@if($label)
<label for="{{ $name }}" class="block text-gray-500 font-bold my-3">
	{{ __($label) }}
	@if($required)<span class="text-red-600 ml-1">*</span>@endif
</label>
@endif

<select name="{{$name}}" id="{{$name}}">
	{{$slot}}
</select>

@error($name)
<span class="text-red-600 my-2 block">{{ $message }}</span>
@enderror

@pushonce('scripts')
<script>
	const selects = document.querySelectorAll('select');
	for (const select of selects) {
			const div = document.createElement('div');
			const header = document.createElement('div');
			const datalist = document.createElement('datalist');
			const optgroups = select.querySelectorAll('optgroup');
			const span = document.createElement('span');
			const img = document.createElement('img');
			const options = select.options;
			const parent = select.parentElement;
			const multiple = select.hasAttribute('multiple');
			const onclick = function(e) {
					const disabled = this.hasAttribute('data-disabled');
					select.value = this.dataset.value;
					img.src = this.dataset.image;
					img.classList.add('ml-2', 'mr-1')
					img.width = 35;
					img.height = 35;
					header.insertBefore(img, span);
					span.innerText = this.dataset.label;
					if (disabled) return;
					if (multiple) {
							if (e.shiftKey) {
									const checked = this.hasAttribute("data-checked");
									if (checked) {
											this.removeAttribute("data-checked");
									} else {
											this.setAttribute("data-checked", "");
									};
							} else {
									const options = div.querySelectorAll('.option');
									for (i = 0; i < options.length; i++) {
											const option = options[i];
											option.removeAttribute("data-checked");
									};
									this.setAttribute("data-checked", "");
							};
					};
			};
			const onkeyup = function(e) {
					e.preventDefault();
					e.stopPropagation();
					if (e.keyCode === 13) {
							this.click();
					}
			};
			div.classList.add('select');
			header.classList.add('header');
			div.tabIndex = 1;
			select.tabIndex = -1;
			span.innerText = select.label;
			header.appendChild(span);
			header.appendChild(img);
			for (attribute of select.attributes) div.dataset[attribute.name] = attribute.value;
			for (i = 0; i < options.length; i++) {
					const option = document.createElement('div');
					const label = document.createElement('div');
					const img = document.createElement('img');
					const o = options[i];
					for (attribute of o.attributes) option.dataset[attribute.name] = attribute.value;
					option.classList.add('option');
					label.classList.add('label', 'inline-block', 'align-middle');
					label.innerText = o.label;
					img.src = o.attributes.image.value;
					img.classList.add('inline-block', 'align-middle', 'mr-2')
					img.width = 35;
					img.height = 35;
					option.dataset.value = o.value;
					option.dataset.label = o.label;
					option.dataset.image = o.attributes.image.value;
					option.onclick = onclick;
					option.onkeyup = onkeyup;
					option.tabIndex = i + 1;
					option.appendChild(img);
					option.appendChild(label);
					datalist.appendChild(option);
			}
			div.appendChild(header);
			for (o of optgroups) {
				const optgroup = document.createElement('div');
				const label = document.createElement('div');
				const options = o.querySelectorAll('option');
				Object.assign(optgroup, o);
				optgroup.classList.add('optgroup');
				label.classList.add('label');
				label.innerText = o.label;
				optgroup.appendChild(label);
				div.appendChild(optgroup);
				for (o of options) {
						const option = document.createElement('div');
						const label = document.createElement('div');
						const img = document.createElement('img');
						for (attribute of o.attributes) option.dataset[attribute.name] = attribute.value;
						option.classList.add('option');
						label.classList.add('label', 'inline-block', 'align-middle');
						label.innerText = o.label;
						img.src = o.attributes.image.value;
						img.classList.add('inline-block', 'align-middle', 'mr-2')
						img.width = 35;
						img.height = 35;
						option.tabIndex = i + 1;
						option.dataset.value = o.value;
						option.dataset.label = o.label;
						option.dataset.image = o.attributes.image.value;
						option.onclick = onclick;
						option.onkeyup = onkeyup;
						option.tabIndex = i + 1;
						option.appendChild(img);
						option.appendChild(label);
						optgroup.appendChild(option);
				};
		};
		div.onclick = function(e) {
				e.preventDefault();
		}
		parent.insertBefore(div, select);
		header.appendChild(select);
		div.appendChild(datalist);
		datalist.style.top = document.querySelector('.header').offsetHeight - 20  + 'px';
		div.onclick = function(e) {
				if (multiple) {

				} else {
						const open = this.hasAttribute("data-open");
						e.stopPropagation();
						if (open) {
								this.removeAttribute("data-open");
						} else {
								this.setAttribute("data-open", "");
						}
				}
		};
		div.onkeyup = function(event) {
				event.preventDefault();
				if (event.keyCode === 13) {
						this.click();
				}
		};
		document.addEventListener('click', function(e) {
				if (div.hasAttribute("data-open")) div.removeAttribute("data-open");
		});
		[...Array.from(options)].map(o => {
			const span = document.createElement('span');
			const img = document.createElement('img');
			if(o.attributes.checked) {
				select.value = o.attributes.value.value
				span.innerText = o.attributes.label.value;
				img.src = o.attributes.image.value;
				img.classList.add('ml-2', 'mr-1')
				img.width = 35;
				img.height = 35;
				header.appendChild(span, img);
			} 
		});
		if(options.length > 0) {
			select.value = options[0].attributes.value.value
			span.innerText = options[0].attributes.label.value;
			img.src = options[0].attributes.image.value;
			img.classList.add('ml-2', 'mr-1')
			img.width = 35;
			img.height = 35;
			header.appendChild(span, img);
		} else {
			select.value = '';
			span.innerText = "{{$placeholder}}";
			header.appendChild(span);
		}
		
	}

	function resetSelect(SelectId = 'select') {
		const options = document.getElementById(SelectId).getElementsByTagName('option');
		if(options.length > 0) {
			document.querySelector(`#${SelectId}`).value = options[0].attributes.value.value
			document.querySelector('#createModel div.header').getElementsByTagName('span')[0].innerText = options[0].attributes.label.value;
			document.querySelector('#createModel div.header').getElementsByTagName('img')[0].src = options[0].attributes.image.value;
			document.querySelector('#createModel div.header').getElementsByTagName('img')[0].classList.add('ml-2', 'mr-1')
			document.querySelector('#createModel div.header').getElementsByTagName('img')[0].width = 35;
			document.querySelector('#createModel div.header').getElementsByTagName('img')[0].height = 35;
		}
		
	}
</script>
@endpushonce