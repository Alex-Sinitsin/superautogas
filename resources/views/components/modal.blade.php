@props(['id' => '', 'title' => ''])

<div {{ $attributes->class(["modal fixed top-0 left-0 hidden bg-gray-600 bg-opacity-80 w-full h-full outline-none overflow-x-hidden overflow-y-auto justify-center items-center"]) }} id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}Label" aria-hidden="true">
			<div class="modal-dialog h-full flex justify-center items-center sm:w-2/3 xl:w-2/5 mx-2 relative sm:mx-auto pointer-events-none animate__animated animate__fadeIn my-5">
				<div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
					<div class="modal-header flex flex-shrink-0 items-center justify-between px-4 py-2 border-b border-gray-200 rounded-t-md">
						<h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
							{{ __($title)}}
						</h5>
						<x-button icon="close" class="close-btn text-2xl hover:text-red-500" />
					</div>
					<div class="modal-body relative p-4">
						{{$slot}}
					</div>
				</div>
			</div>
		</div>