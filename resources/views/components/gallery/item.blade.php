<div {{$attributes->class(["gallery-item m-2 min-h-[200px] bg-blue-200 rounded-md"])}} {{$attributes}}>
  {{$logotype ?? '' }}

  <div class="models bg-blue-100 relative pl-2 w-full p-2 max-h-full min-h-[200px] shadow-inner shadow-slate-400">
    {{$slot}}
  </div>
</div>