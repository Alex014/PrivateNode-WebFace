<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrivateNess Network</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a86ff;
            --secondary: #8338ec;
            --accent: #ff006e;
            --dark: #0d1b2a;
            --darker: #070f1c;
            --light: #e0e1dd;
            --card-bg: rgba(255, 255, 255, 0.05);
            --card-border: rgba(255, 255, 255, 0.1);
            --glow: 0 0 20px rgba(58, 134, 255, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 50%, #1b263b 100%);
            color: var(--light);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(58, 134, 255, 0.1);
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-20px) translateX(10px); }
            100% { transform: translateY(0) translateX(0); }
        }

        .container {
            max-width: 95%;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 0;
            margin-bottom: 3rem;
            border-bottom: 1px solid var(--card-border);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-icon {
            width: 3.5rem;
            height: 3.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--glow);
            position: relative;
            overflow: hidden;
        }

        .logo-text {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 2px 10px rgba(58, 134, 255, 0.3);
        }

        .tagline {
            font-size: 1rem;
            color: #a0a0c0;
            margin-top: 0.3rem;
            letter-spacing: 1px;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 4rem;
        }

        .network-status {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 2rem;
            padding: 0.8rem 1.5rem;
            background: var(--card-bg);
            border-radius: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid var(--card-border);
            box-shadow: var(--glow);
        }

        .status-indicator {
            width: 0.8rem;
            height: 0.8rem;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse 2s infinite;
            box-shadow: 0 0 10px #4ade80;
        }

        @keyframes pulse {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
            100% { opacity: 1; transform: scale(1); }
        }

        .links-section {
            width: 100%;
            margin: 3rem 0;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            text-align: center;
            margin-bottom: 3rem;
            color: #fff;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 3px;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .link-card {
            background: var(--card-bg);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
            border: 1px solid var(--card-border);
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .link-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }

        .link-card:hover {
            transform: translateY(-15px);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3), var(--glow);
        }

        .link-icon {
            width: 5rem;
            height: 5rem;
            margin: 0 auto 1.5rem;
            border-radius: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            position: relative;
            overflow: hidden;
        }

        .cp-icon {
            background: linear-gradient(135deg, var(--primary), #4895ef);
        }

        .wallet-icon {
            background: linear-gradient(135deg, var(--secondary), #3a0ca3);
        }

        .explorer-icon {
            background: linear-gradient(135deg, #7209b7, #560bad);
        }

        .blog-icon {
            background: linear-gradient(135deg, var(--accent), #b5179e);
        }

        .ipfs-icon {
            background: linear-gradient(135deg, #4cc9f0, var(--primary));
        }

        .link-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
            font-weight: 700;
        }

        .link-card p {
            color: #b8b8d0;
            font-size: 1rem;
            margin-bottom: 2rem;
            flex: 1;
            line-height: 1.6;
        }

        .link-button {
            display: inline-block;
            padding: 0.8rem 1.3rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 2rem;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .link-button:hover {
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 6px 20px rgba(58, 134, 255, 0.3);
            transform: translateY(-3px);
        }

        footer {
            text-align: center;
            padding: 3rem 0;
            margin-top: 5rem;
            border-top: 1px solid var(--card-border);
            color: #a0a0c0;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .container {
                max-width: 98%;
            }
            
            .links-grid {
                grid-template-columns: 1fr;
            }
            
            .logo-text {
                font-size: 1.8rem;
            }
            
            header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .link-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .link-card:nth-child(1) { animation-delay: 0.1s; }
        .link-card:nth-child(2) { animation-delay: 0.2s; }
        .link-card:nth-child(3) { animation-delay: 0.3s; }
        .link-card:nth-child(4) { animation-delay: 0.4s; }
        .link-card:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body>


<div class="particles" id="particles"></div>
    
    <div class="container">
        <header>
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <div class="logo-text">PrivateNess Network</div>
                    <div class="tagline">Decentralized Privacy Infrastructure</div>
                </div>
            </div>
        </header>