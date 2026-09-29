<!DOCTYPE html>
<html class="js no-touch">
<head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{ env('APP_NAME') }} - TaskHall</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
</head> 
<body class="wBg"> 

<div class="headTop" style="background: none"> 
  <a href="{{ url('/user') }}"> 
    <i class="layui-icon layui-icon-left" style="color: #000"></i> 
  </a> 
  TaskHall 
</div> 

<h2 class="taskName"></h2> 

@php
  $referUsers = \App\Models\User::where('ref_by', auth()->user()->ref_id)
      ->where('investor', 1)
      ->count();
@endphp

@foreach(\App\Models\Task::all() as $task)
  @php
      $apply = \App\Models\TaskRequest::where('task_id', $task->id)
              ->where('user_id', auth()->id())
              ->where('status', '!=', 'rejected')
              ->first();

      $progress = min(100, ($referUsers / $task->team_size) * 100);
      $currentCount = min($referUsers, $task->team_size);
      $isClaimable = !$apply && $referUsers >= $task->team_size;
  @endphp

  <div class="task"> 
    <ul> 
      <li> 
        <h2>Reward <span>{{ price($task->bonus) }}</span></h2> 
        <div class="task-img"> 
          <img src="/static/home/images/q_1.png" alt=""> 
        </div> 
        <div class="task-left"> 
          <div class="task-left-hd"> 
            <h3>{{ $task->name ?? "Invite {$task->team_size} valid users" }}</h3> 
            <div class="task-left-bd"> 
              <div class="task-bar"> 
                <span style="width: {{ $progress }}%"></span> 
              </div> 
              <label>{{ $currentCount }}/{{ $task->team_size }}</label> 
            </div> 
          </div> 
          <div class="task-link"> 
            @if($isClaimable)
              <a href="{{ route('user.received.reward', $task->id) }}" class="taskBtn">Receive</a> 
            @elseif($apply)
              <a href="javascript:void(0);" class="taskDone">Completed</a> 
            @else
              <a href="javascript:void(0);" class="taskNone">Not Eligible</a> 
            @endif
          </div> 
        </div> 
      </li>  
    </ul> 
  </div> 
@endforeach

@include('alert-message')

<!-- ✅ Global Copy Function -->
<script>
function copyLink(text) {
    const body = document.body;
    const input = document.createElement("input");
    body.append(input);
    input.style.opacity = 0;
    input.value = text.replaceAll(' ', '');
    input.select();
    document.execCommand("Copy");
    input.remove();
    alert('Copied successfully.');
}
</script>

</body>
</html>
