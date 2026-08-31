<?php
$data = json_decode(file_get_contents('data.json'), true);
$items = $data['items'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Namz New Era - Spin Wheel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #0f172a, #1e1b4b); color: #fff; font-family: 'Inter', sans-serif; }
        .glass { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .wheel-container { position: relative; width: 320px; height: 320px; margin: auto; }
        canvas { width: 100%; height: 100%; filter: drop-shadow(0 10px 25px rgba(0,0,0,0.5)); }
        .pointer {
            position: absolute; top: -15px; left: 50%; transform: translateX(-50%);
            width: 0; height: 0; border-left: 15px solid transparent;
            border-right: 15px solid transparent; border-top: 25px solid #facc15;
            z-index: 10; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-between p-4">

    <header class="text-center mt-4">
        <h1 class="text-2xl font-black tracking-wider text-cyan-400 uppercase">Namz Spin Wheel</h1>
        <p class="text-xs text-slate-400">Putar roda dan tentukan keberuntunganmu!</p>
    </header>

    <main class="flex flex-col items-center my-auto">
        <div class="wheel-container">
            <div class="pointer"></div>
            <canvas id="wheelCanvas" width="500" height="500"></canvas>
            <div onclick="spinWheel()" class="absolute inset-0 m-auto w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-xl cursor-pointer hover:scale-105 transition active:scale-95 border-4 border-slate-800 z-20">
                <span class="text-slate-900 font-bold text-xs uppercase text-center leading-tight">Tap to<br>Spin</span>
            </div>
        </div>
        
        <div id="resultBox" class="mt-8 hidden glass px-6 py-3 rounded-xl border border-cyan-500/30 text-center animate-bounce">
            <p class="text-xs text-slate-400">Pemenang Terpilih:</p>
            <h2 id="winnerName" class="text-xl font-bold text-cyan-300"></h2>
        </div>
    </main>

    <footer class="text-xs text-slate-500 mb-2">
        &copy; 2023 Namz New Era. All rights reserved.
    </footer>

    <script>
        const items = <?php echo json_encode($items); ?>;
        const canvas = document.getElementById('wheelCanvas');
        const ctx = canvas.getContext('2d');
        const totalSlices = items.length;
        const arcSize = (2 * Math.PI) / totalSlices;
        
        let startAngle = 0;
        let spinAngleTimeout = null;
        let spinArcStart = 10;
        let spinTime = 0;
        let spinTimeTotal = 0;
        let isSpinning = false;

        function drawWheel() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            const outsideRadius = 220;
            const textRadius = 150;
            const insideRadius = 40;
            const center = canvas.width / 2;

            items.forEach((item, i) => {
                const angle = startAngle + i * arcSize;
                ctx.fillStyle = item.color || getRandomColor(i);
                
                ctx.beginPath();
                ctx.arc(center, center, outsideRadius, angle, angle + arcSize, false);
                ctx.arc(center, center, insideRadius, angle + arcSize, angle, true);
                ctx.stroke();
                ctx.fill();

                ctx.save();
                ctx.fillStyle = "#FFFFFF";
                ctx.translate(center + Math.cos(angle + arcSize / 2) * textRadius, center + Math.sin(angle + arcSize / 2) * textRadius);
                ctx.rotate(angle + arcSize / 2 + Math.PI / 2);
                ctx.font = 'bold 16px Inter, sans-serif';
                ctx.fillText(item.name, -ctx.measureText(item.name).width / 2, 0);
                ctx.restore();
            });
        }

        function getRandomColor(index) {
            const colors = ['#3b82f6', '#ef4444', '#f59e0b', '#10b981', '#8b5cf6', '#ec4899', '#06b6d4'];
            return colors[index % colors.length];
        }

        function spinWheel() {
            if (isSpinning || items.length === 0) return;
            isSpinning = true;
            document.getElementById('resultBox').classList.add('hidden');

            spinAngleStart = Math.random() * 10 + 10;
            spinTime = 0;
            spinTimeTotal = Math.random() * 3000 + 4000; // 4-7 detik
            rotateWheel();
        }

        function rotateWheel() {
            spinTime += 30;
            if (spinTime >= spinTimeTotal) {
                stopRotateWheel();
                return;
            }
            let spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
            startAngle += (spinAngle * Math.PI / 180);
            drawWheel();
            spinAngleTimeout = setTimeout(rotateWheel, 30);
        }

        function stopRotateWheel() {
            isSpinning = false;
            clearTimeout(spinAngleTimeout);
            
            // Hitung pemenang berdasarkan persentase yang sudah diatur di Admin
            fetch('get_winner.php')
                .then(res => res.json())
                .then(data => {
                    // Paksa jarum berhenti tepat di item yang terpilih secara matematis
                    const winningIndex = data.index;
                    const targetAngle = 1.5 * Math.PI - (winningIndex * arcSize + arcSize / 2);
                    startAngle = targetAngle % (2 * Math.PI);
                    drawWheel();

                    document.getElementById('winnerName').innerText = data.name;
                    document.getElementById('resultBox').classList.remove('hidden');
                });
        }

        function easeOut(t, b, c, d) {
            let ts = (t /= d) * t;
            let tc = ts * t;
            return b + c * (tc + -3 * ts + 3 * t);
        }

        drawWheel();
    </script>
</body>
</html>
