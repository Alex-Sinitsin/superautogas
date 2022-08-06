<div {{$attributes->class(["gallery-item m-2 min-h-[200px] bg-blue-100 rounded-md"])}}>
  {{$logotype ?? '' }}

  <div class="models bg-blue-100 pl-2 w-full p-2 h-full rounded-tr-md shadow-inner shadow-slate-400">
    {{$slot}}
  </div>
</div>