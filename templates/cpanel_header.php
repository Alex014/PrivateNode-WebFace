<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel - PrivateNess Network</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a86ff;
            --secondary: #8338ec;
            --other:rgb(11, 131, 81);
            --accent: #ff006e;
            --dark: #0d1b2a;
            --darker: #070f1c;
            --light: #e0e1dd;
            --card-bg: rgba(255, 255, 255, 0.05);
            --card-border: rgba(255, 255, 255, 0.1);
            --glow: 0 0 20px rgba(58, 134, 255, 0.3);
            --success: #4ade80;
            --warning: #f59e0b;
            --danger: #ef4444;
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

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.5rem;
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

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 6px 20px rgba(58, 134, 255, 0.3);
            transform: translateY(-3px);
        }

        .cpanel-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            text-align: center;
            margin-bottom: 2rem;
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

        .cpanel-section {
            background: var(--card-bg);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid var(--card-border);
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .cpanel-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }

        .cpanel-section:hover {
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3), var(--glow);
        }

        .service-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .service-item {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid var(--card-border);
            transition: all 0.3s ease;
        }

        .service-item:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-5px);
        }

        .service-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .service-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .service-details h4 {
            font-size: 1.2rem;
            margin-bottom: 0.3rem;
            color: white;
        }

        .service-details p {
            font-size: 0.9rem;
            color: #b8b8d0;
        }

        .service-controls {
            display: flex;
            gap: 0.8rem;
        }

        .btn {
            padding: 0.6rem 0.7rem;
            border: none;
            border-radius: 0.4rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .btn-start {
            background: var(--success);
            color: white;
        }

        .btn-stop {
            background: var(--danger);
            color: white;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .system-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .action-card {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid var(--card-border);
            transition: all 0.3s ease;
        }

        .action-card:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-5px);
        }

        .action-icon {
            width: 4rem;
            height: 4rem;
            margin: 0 auto 1rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }

        .cert-icon {
            background: linear-gradient(135deg, var(--primary), #4895ef);
        }

        .upgrade-icon {
            background: linear-gradient(135deg, var(--secondary), #3a0ca3);
        }

        .update-icon {
            background: linear-gradient(135deg, var(--other),rgb(3, 63, 38));
        }

        .backup-icon {
            background: linear-gradient(135deg, var(--success), #16a34a);
        }

        #backup-btn {
            cursor: pointer;
        }

        #restore-btn {
            cursor: pointer;
        }

        #restore-confirmation,.checkbox-label {
            cursor: pointer;
        }

        .restore-icon {
            background: linear-gradient(135deg, var(--warning), #d97706);
        }

        .action-card h4 {
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
            color: white;
        }

        .action-card p {
            font-size: 0.9rem;
            color: #b8b8d0;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-secondary {
            background: var(--secondary);
            color: white;
        }

        .btn-other {
            background: var(--other);
            color: white;
        }

        .password-form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .form-group label {
            font-weight: 600;
            color: white;
        }

        .form-control {
            padding: 1rem;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--card-border);
            border-radius: 0.8rem;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(58, 134, 255, 0.3);
        }

        .btn-submit {
            background: var(--accent);
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 0.8rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background: #e00063;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 0, 110, 0.3);
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
            
            .service-list {
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

        .cpanel-section {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .cpanel-section:nth-child(1) { animation-delay: 0.1s; }
        .cpanel-section:nth-child(2) { animation-delay: 0.2s; }
        .cpanel-section:nth-child(3) { animation-delay: 0.3s; }

        .status-running {
            color: var(--success);
            font-weight: 600;
        }

        .status-stopped {
            color: var(--danger);
            font-weight: 600;
        }

        .status-process {
            color: var(--warning);
            font-weight: 600;
        }

        input[name=restore] {
            display: none;
        }
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
                    <div class="tagline">Control Panel</div>
                </div>
            </div>
            <a href="http://<?= IPADDR ?>" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </header>
        
        <div class="cpanel-container">