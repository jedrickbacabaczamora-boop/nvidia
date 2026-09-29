<!DOCTYPE html>
<html class=" js no-touch">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>WAF - Reward</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="wap-font-scale" content="no">
    <link rel="stylesheet" href="/static/home/new/reset.css">
    <link rel="stylesheet" href="/static/home/new/style.css">
    <script type="text/javascript" src="/static/home/new/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/static/home/new/layui.js"></script>
    <link rel="stylesheet" href="/static/reset.css"/>
    <link rel="stylesheet" href="/static/style.css"/>
    <link rel="stylesheet" href="/static/layui.css"/>
    <script type="text/javascript" src="/static/layui.js"></script>
    <script type="text/javascript" src="/static/jquery-3.5.1.min.js"></script>
   <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="inlineBg">
    <div class="content">
        <div class="task">
            <div class="form-head">
                <div class="form-nav">
                    <a href="#" class="on" onclick="showTab(event, 'daily')">Daily Reward</a>
                    <a href="#" onclick="showTab(event, 'teams')">Teams Reward</a>
                </div>
            </div>

            <!-- Daily Reward Section -->
            <div id="daily" class="tab-content">
                @php
                    $rewards = [
                        ['bonus' => 100, 'required_invites' => 3],
                        ['bonus' => 200, 'required_invites' => 5],
                        ['bonus' => 500, 'required_invites' => 10],
                        ['bonus' => 1000, 'required_invites' => 20],
                    ];
                @endphp

               @foreach ($rewards as $reward)
    @php
        $claimed = in_array($reward['bonus'], $claimed_rewards);
        $progress = min(($first_level_invite_count / $reward['required_invites']) * 100, 100);
        $can_claim = !$claimed && $first_level_invite_count >= $reward['required_invites'];
    @endphp
    <div class="task-list">
        <div class="task-top">
            <ul>
                <li><h3>{{ $reward['bonus'] }} Rs</h3><span>Bonus</span></li>
                <li><h3>{{ $first_level_invite_count }} / {{ $reward['required_invites'] }}</h3><span>Invitations</span></li>
                <li><h3>{{ number_format($progress, 0) }} %</h3><span>Completed</span></li>
            </ul>
        </div>
        <div class="task-line">
            <div class="task-line-hd">
                <div class="task-line-bd" style="width: {{ $progress }}%;"></div>
            </div>
        </div>
        <div class="task-join">
            <button type="button" class="form-button {{ !$can_claim ? 'disabled' : '' }}" data-id="{{ $reward['bonus'] }}" {{ !$can_claim ? 'disabled' : '' }}>
                {{ $claimed ? 'Claimed' : 'Obtain' }}
            </button>
        </div>
    </div>
@endforeach
 </div>

          <!-- Team Reward Section -->
<div id="teams" class="tab-content" style="display:none;">
    <div class="task-list">
        @php
            $team_rewards = [
                ['bonus' => 300, 'required_invites' => 3, 'required_teams' => 10],
                ['bonus' => 2000, 'required_invites' => 10, 'required_teams' => 50],
                ['bonus' => 8000, 'required_invites' => 20, 'required_teams' => 100],
                ['bonus' => 15000, 'required_invites' => 30, 'required_teams' => 300],
                ['bonus' => 30000, 'required_invites' => 50, 'required_teams' => 500],
                ['bonus' => 50000, 'required_invites' => 60, 'required_teams' => 1000],
            ];
        @endphp

        @foreach ($team_rewards as $reward)
            @php
                // Check if the user can claim the reward
                $can_claim_team = $first_level_invite_count >= $reward['required_invites'] && $total_count >= $reward['required_teams'];
            @endphp
            <div class="task-top">
                <ul>
                    <li>
                        <h3>{{ $reward['bonus'] }} Rs</h3>
                        <span>Bonus</span>
                    </li>
                    <li>
                        <h3>{{ $first_level_invite_count }} / {{ $reward['required_invites'] }}</h3>
                        <span>Invitations</span>
                    </li>
                    <li>
                        <h3>{{ $total_count }} / {{ $reward['required_teams'] }}</h3>
                        <span>Team Members</span>
                    </li>
                </ul>
            </div>
            <div class="task-join">
                <button 
                    type="button" 
                    class="form-button {{ !$can_claim_team ? 'disabled' : '' }}" 
                    data-id="{{ $reward['bonus'] }}" 
                    {{ !$can_claim_team ? 'disabled' : '' }}>
                    {{ $can_claim_team ? 'Obtain' : 'Claimed' }}
                </button>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Tab switching logic
    function showTab(event, tabName) {
        event.preventDefault();
        const tabcontent = document.getElementsByClassName("tab-content");
        const tablinks = document.getElementsByClassName("form-nav")[0].getElementsByTagName("a");

        // Hide all tab contents
        Array.from(tabcontent).forEach(tab => tab.style.display = "none");

        // Remove 'on' class from all tab links
        Array.from(tablinks).forEach(link => link.className = link.className.replace(" on", ""));

        // Show current tab and add 'on' class
        document.getElementById(tabName).style.display = "block";
        event.currentTarget.className += " on";
    }

    // Claim reward logic
    document.querySelectorAll('.form-button').forEach(button => {
        button.addEventListener('click', function () {
            const bonus = this.getAttribute('data-id');
            if (!this.classList.contains('disabled')) {
                console.log("Claiming reward with bonus:", bonus);

                fetch("{{ route('claim.reward') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ bonus: bonus })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    if (data.status === 'success') {
                        this.innerText = 'Claimed';
                        this.classList.add('disabled');
                        this.setAttribute('disabled', true);
                        location.reload(); // Reload to update the view
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again later.');
                });
            } else {
                console.log("Button is disabled.");
            }
        });
    });
</script>

</body>

<div class="foot">
    <ul>
        <li>
            <a href="/home">
                <img src="{{ asset('/public/icons/home.png') }}" alt=""/>
                <p>Home</p>
            </a>
        </li>
        <li>
            <a href="/products">
                <img src="{{ asset('/public/icons/product.png') }}" alt=""/>
                <p>Product</p>
            </a>
        </li>
        <li>
            <a href="/my-team">
                <img src="{{ asset('/public/icons/team.png') }}" alt=""/>
                <p>Team</p>
            </a>
        </li>
        <li class="cur">
            <a href="/profile">
                <img src="{{ asset('/public/icons/mine.png') }}" alt=""/>
                <p>Mine</p>
            </a>
        </li>
    </ul>
</div>
