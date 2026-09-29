<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Lucky Spin Wheel with Center Zero</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  :root {
    --bg: #fff7d1;
    --gold1: #ffeb99;
    --gold2: #ffcc33;
    --gold3: #ffb300;
    --dark: #2b2b2b;
    --muted: #a89a6b;
    --card: rgba(255,255,255,0.7);
    --shadow: 0 8px 25px rgba(0,0,0,.1);
    --gold-gradient: linear-gradient(145deg,#ffeb99 0%, #ffcc33 50%, #ffb300 100%);
  }
  html, body {
    height: 100%;
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top left, #fffbe8, #ffe59c);
    color: var(--dark);
    -webkit-font-smoothing: antialiased;
  }
  .app {
    max-width: 420px;
    margin: auto;
    padding: 16px;
  }
  .top {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
  }
  .back {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--card);
    border: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow);
    backdrop-filter: blur(6px);
    font-size: 24px;
    cursor: pointer;
  }
  .title {
    flex: 1;
    font-weight: 800;
    font-size: 18px;
    text-align: center;
  }
  .card {
    background: var(--card);
    backdrop-filter: blur(8px);
    border-radius: 16px;
    padding: 14px;
    margin-bottom: 14px;
    box-shadow: var(--shadow);
  }
  .userRow {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: var(--gold-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #fff;
    font-size: 18px;
    box-shadow: inset 0 4px 10px rgba(255,255,255,0.5);
  }
  .uid {
    font-weight: 700;
  }
  .phone {
    font-size: 13px;
    color: var(--muted);
    margin-top: 3px;
  }
  .balances {
    display: flex;
    gap: 12px;
    margin-top: 12px;
  }
  .balanceItem {
    flex: 1;
    background: rgba(255,255,255,0.5);
    padding: 10px;
    border-radius: 10px;
    text-align: left;
    box-shadow: inset 0 2px 5px rgba(0,0,0,.05);
  }
  .label {
    font-size: 12px;
    color: var(--muted);
  }
  .value {
    font-size: 20px;
    font-weight: 800;
    margin-top: 6px;
    color: #000;
  }
  .wheelArea {
    text-align: center;
    margin: 18px 0;
  }
  .wheelWrap {
    position: relative;
    display: inline-block;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: radial-gradient(circle,#fff3d1 0%,#ffd85c 100%);
    overflow: visible;
    box-shadow: 0 15px 30px rgba(0,0,0,0.2), inset 0 4px 12px rgba(255,255,255,0.6);
  }
  svg {
    width: 320px;
    height: 320px;
    transform-origin: 50% 50%;
    user-select: none;
  }
  #wheelSlices {
    transition-timing-function: ease-out;
  }
  .wheelCenter {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: var(--gold-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    color: #fff;
    font-size: 32px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.3), inset 0 4px 10px rgba(255,255,255,0.6);
    cursor: pointer;
    transition: transform 0.2s;
    user-select: none;
    z-index: 10;
  }
  .wheelCenter:active {
    transform: translate(-50%, -50%) scale(0.95);
  }
  .pointer {
    position: absolute;
    left: 50%;
    top: -14px;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 18px solid transparent;
    border-right: 18px solid transparent;
    border-bottom: 28px solid #fff;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,.15));
    z-index: 20;
  }
  .result {
    margin-top: 14px;
    text-align: center;
    font-weight: 700;
    font-size: 16px;
  }
  .history {
    margin-top: 18px;
  }
  .historyList {
    display: flex;
    flex-direction: column;
    gap: 8px;
    max-height: 180px;
    overflow-y: auto;
  }
  .histItem {
    display: flex;
    justify-content: space-between;
    background: var(--card);
    backdrop-filter: blur(6px);
    padding: 10px;
    border-radius: 10px;
    box-shadow: var(--shadow);
    font-size: 14px;
  }
  @media(max-width:360px) {
    .wheelWrap {
      width: 280px;
      height: 280px;
    }
    svg {
      width: 280px;
      height: 280px;
    }
    .wheelCenter {
      width: 80px;
      height: 80px;
      font-size: 28px;
    }
  }
</style>
</head>
<body>
<div class="app" role="main">
  <div class="top">
    <button class="back" id="btnBack" title="Back">‹</button>
    <div class="title">Lucky Spin Wheel</div>
    <div style="width:40px;"></div>
  </div>

  <div class="card">
    <div class="userRow">
      <div class="avatar" id="avatar">{{ substr($user->name ?? 'K6', 0, 2) }}</div>
      <div class="userInfo">
        <div class="uid" id="uid">ID: {{ strtoupper($user->id ?? 'K6QG1J') }}</div>
        <div class="phone" id="phone">{{ $user->phone ?? '+27 901******86' }}</div>
      </div>
      <div style="text-align:right">
        <div style="font-size:12px;color:var(--muted)">Total Balance</div>
        <div class="value" id="balance">₦{{ number_format($user->balance ?? 102, 2) }}</div>
      </div>
    </div>
    <div class="balances">
      <div class="balanceItem">
        <div class="label">Deposit Balance</div>
        <div class="value" id="deposit">₦{{ number_format($user->deposit_balance ?? 0, 2) }}</div>
      </div>
      <div class="balanceItem">
        <div class="label">Bonus</div>
        <div class="value" id="bonus">₦{{ number_format($user->bonus ?? 0, 2) }}</div>
      </div>
    </div>
    <p id="chances">You have <strong>{{ $chances }}</strong> chances to participate in the lottery</p>
  </div>

  <div class="wheelArea">
    <div class="wheelWrap" role="region" aria-label="Spin Wheel">
      <div class="pointer" title="Pointer"></div>
      <svg viewBox="-160 -160 320 320" xmlns="http://www.w3.org/2000/svg" aria-label="Spin Wheel SVG" role="img">
        <g id="wheelSlices" aria-live="polite"></g>
      </svg>
      <div class="wheelCenter" id="spinBtn" role="button" aria-pressed="false" tabindex="0" title="Spin the Wheel">0</div>
    </div>
    <div class="result" id="result" aria-live="polite"></div>
  </div>

  <div class="history card" aria-label="Spin History">
    <h4>Spin History</h4>
    <div class="historyList" id="historyList"></div>
  </div>
</div>

<script>
  const prizes = [
    {label: "₦50", color: "#d32f2f"},
    {label: "₦100", color: "#388e3c"},
    {label: "₦250", color: "#f5f5f5"},
    {label: "₦500", color: "#212121"},
    {label: "₦750", color: "#ef5350"},
    {label: "₦1000", color: "#66bb6a"},
    {label: "₦2000", color: "#eeeeee"},
    {label: "₦3000", color: "#424242"},
  ];

  const svgGroup = document.getElementById('wheelSlices');
  const R_outer = 130;
  const R_inner = 75;
  const sliceCount = prizes.length;
  const angleStep = (2 * Math.PI) / sliceCount;

  function polarToCartesian(r, theta) {
    return [r * Math.cos(theta), r * Math.sin(theta)];
  }

  function createSlicePath(i) {
    const startAngle = i * angleStep - Math.PI / 2;
    const endAngle = startAngle + angleStep;

    const [x1, y1] = polarToCartesian(R_inner, startAngle);
    const [x2, y2] = polarToCartesian(R_outer, startAngle);
    const [x3, y3] = polarToCartesian(R_outer, endAngle);
    const [x4, y4] = polarToCartesian(R_inner, endAngle);

    const largeArc = angleStep > Math.PI ? 1 : 0;

    return `
      M${x1} ${y1}
      L${x2} ${y2}
      A${R_outer} ${R_outer} 0 ${largeArc} 1 ${x3} ${y3}
      L${x4} ${y4}
      A${R_inner} ${R_inner} 0 ${largeArc} 0 ${x1} ${y1}
      Z
    `;
  }

  function getTextColor(bgColor) {
    const c = bgColor.toLowerCase();
    if (c === '#212121' || c === '#424242') return '#ffffff';
    if (c === '#f5f5f5' || c === '#eeeeee') return '#000000';
    if (c === '#d32f2f') return '#ffffff';
    if (c === '#ef5350') return '#000000';
    if (c === '#388e3c') return '#ffffff';
    if (c === '#66bb6a') return '#000000';
    return '#000000';
  }

  function drawWheel() {
    svgGroup.innerHTML = '';
    prizes.forEach((prize, i) => {
      const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
      path.setAttribute('d', createSlicePath(i));
      path.setAttribute('fill', prize.color);
      path.setAttribute('stroke', '#fff');
      path.setAttribute('stroke-width', '2');
      svgGroup.appendChild(path);

      const midAngle = i * angleStep + angleStep / 2 - Math.PI / 2;
      const labelRadius = (R_outer + R_inner) / 2;
      const [lx, ly] = polarToCartesian(labelRadius, midAngle);

      const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
      text.setAttribute('x', lx);
      text.setAttribute('y', ly + 6);
      text.setAttribute('text-anchor', 'middle');
      text.setAttribute('fill', getTextColor(prize.color));
      text.setAttribute('font-weight', '700');
      text.setAttribute('font-size', '14');
      text.style.userSelect = 'none';
      text.textContent = prize.label;
      svgGroup.appendChild(text);
    });
  }

  drawWheel();

  let spinning = false;
  let currentRotation = 0;

  async function spin() {
    if (spinning) return;

    const chancesElem = document.querySelector('#chances strong');
    let chances = parseInt(chancesElem.textContent);

    if (chances <= 0) {
      document.getElementById('result').innerHTML = `<strong>No chances left!</strong>`;
      return;
    }

    spinning = true;
    document.getElementById('result').innerHTML = '';
    document.getElementById('spinBtn').setAttribute('aria-pressed', 'true');

    try {
      const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const response = await fetch('{{ route("spin.now") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token,
          'Accept': 'application/json',
        },
        body: JSON.stringify({})
      });
      const data = await response.json();

      if (!data.success) {
        document.getElementById('result').innerHTML = `<strong>${data.message || "Spin failed!"}</strong>`;
        spinning = false;
        document.getElementById('spinBtn').setAttribute('aria-pressed', 'false');
        return;
      }

      // Fast spin animation before final stop
      let spinSpeed = 15;
      let animationFrameId;

      function runSpin() {
        currentRotation = (currentRotation + spinSpeed) % 360;
        svgGroup.style.transform = `rotate(${currentRotation}deg)`;
        animationFrameId = requestAnimationFrame(runSpin);
      }
      runSpin();

      setTimeout(() => {
        cancelAnimationFrame(animationFrameId);

        const degPerSlice = 360 / prizes.length;
        // Prize slice center angle
        const prizeRotation = data.index * degPerSlice + degPerSlice / 2;
        // Calculate final rotation so prize slice center aligns with pointer (top = 0 deg)
        // The wheel starts with slice 0 centered at top when rotation=0 (at -90deg from math angle)
        // So finalRotation = 360 * spins - prizeRotation to rotate wheel CCW to prize center
        const spins = 5;
        const finalRotation = 360 * spins - prizeRotation;

        svgGroup.style.transition = 'transform 4s cubic-bezier(.1,.9,.2,1)';
        svgGroup.style.transform = `rotate(${finalRotation}deg)`;

        svgGroup.addEventListener('transitionend', function onEnd() {
          svgGroup.style.transition = 'none';
          currentRotation = finalRotation % 360;
          svgGroup.style.transform = `rotate(${currentRotation}deg)`;
          svgGroup.removeEventListener('transitionend', onEnd);

          chances--;
          chancesElem.textContent = chances;

          document.getElementById('result').innerHTML = `
            🎉 <strong>You won ${data.amount}!</strong><br>
            <img src="${data.image}" alt="reward" style="max-width:80px; margin-top:10px;">
          `;

          const historyList = document.getElementById('historyList');
          const histItem = document.createElement('div');
          histItem.className = 'histItem';
          const now = new Date().toLocaleTimeString();
          histItem.textContent = `${now} - Won ${data.amount}`;
          historyList.prepend(histItem);

          spinning = false;
          document.getElementById('spinBtn').setAttribute('aria-pressed', 'false');
        }, {once: true});
      }, 3000);

    } catch (error) {
      document.getElementById('result').innerHTML = 'Error. Please try again.';
      spinning = false;
      document.getElementById('spinBtn').setAttribute('aria-pressed', 'false');
    }
  }

  document.getElementById('spinBtn').addEventListener('click', spin);
  document.getElementById('spinBtn').addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      spin();
    }
  });

  document.getElementById('btnBack').addEventListener('click', () => {
    window.history.back();
  });
</script>
</body>
</html>
