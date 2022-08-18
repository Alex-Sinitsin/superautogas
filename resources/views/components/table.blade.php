@props(['id' => ''])

<div class="table-wrapper 2xl:container 2xl:mx-auto">
  <div class="flex flex-col">
    <div class="overflow-x-auto lg:-mx-5">
      <div class="py-2 inline-block min-w-full lg:px-8">
        <div class="overflow-x-auto">
          <table class="min-w-full" id="{{$id}}">
            {{$slot}}
          </table>
        </div>
      </div>
    </div>
  </div>
</div>