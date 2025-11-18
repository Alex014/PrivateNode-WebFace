<section class="cpanel-section">
    <h2 class="section-title">Services</h2>
    <div class="service-list">
        <div class="service-item">
            <div class="service-info">
                <div class="service-icon" style="background: linear-gradient(135deg, var(--primary), #4895ef);">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="service-details">
                    <h4>PrivateNess</h4>
                    <p>Status: <span class="status-running">Running</span></p>
                </div>
            </div>
            <div class="service-controls">
                <button class="btn btn-stop">
                    <i class="fas fa-stop"></i>
                    Stop
                </button>
            </div>
        </div>
        
        <div class="service-item">
            <div class="service-info">
                <div class="service-icon" style="background: linear-gradient(135deg, var(--secondary), #3a0ca3);">
                    <i class="fas fa-search"></i>
                </div>
                <div class="service-details">
                    <h4>Blockchain Explorer</h4>
                    <p>Status: <span class="status-running">Running</span></p>
                </div>
            </div>
            <div class="service-controls">
                <button class="btn btn-stop">
                    <i class="fas fa-stop"></i>
                    Stop
                </button>
            </div>
        </div>
        
        <div class="service-item">
            <div class="service-info">
                <div class="service-icon" style="background: linear-gradient(135deg, #7209b7, #560bad);">
                    <i class="fab fa-bitcoin"></i>
                </div>
                <div class="service-details">
                    <h4>Emercoin</h4>
                    <p>Status: <span class="status-stopped">Stopped</span></p>
                </div>
            </div>
            <div class="service-controls">
                <button class="btn btn-start">
                    <i class="fas fa-play"></i>
                    Start
                </button>
            </div>
        </div>
        
        <div class="service-item">
            <div class="service-info">
                <div class="service-icon" style="background: linear-gradient(135deg, #4cc9f0, var(--primary));">
                    <i class="fas fa-network-wired"></i>
                </div>
                <div class="service-details">
                    <h4>IPFS</h4>
                    <p>Status: <span class="status-running">Running</span></p>
                </div>
            </div>
            <div class="service-controls">
                <button class="btn btn-stop">
                    <i class="fas fa-stop"></i>
                    Stop
                </button>
            </div>
        </div>
        
        <div class="service-item">
            <div class="service-info">
                <div class="service-icon" style="background: linear-gradient(135deg, var(--accent), #b5179e);">
                    <i class="fas fa-file-upload"></i>
                </div>
                <div class="service-details">
                    <h4>FTP</h4>
                    <p>Status: <span class="status-stopped">Stopped</span></p>
                </div>
            </div>
            <div class="service-controls">
                <button class="btn btn-start">
                    <i class="fas fa-play"></i>
                    Start
                </button>
            </div>
        </div>
    </div>
</section>

<script>
let wait = false;

// Service control functionality
document.querySelector('.service-list').addEventListener('mouseover', function() {
    wait = true;
});

document.querySelector('.service-list').addEventListener('mouseout', function() {
    wait = false;
});


function addEvents() {
    const serviceButtons = document.querySelectorAll('.btn-start, .btn-stop');
    serviceButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceItem = this.closest('.service-item');
            const statusElement = serviceItem.querySelector('.status-running, .status-stopped');
            const isRunning = statusElement.classList.contains('status-running');

            if (isRunning) {
                // Stop service
                commandService(serviceItem.dataset.service, 'stop')
            } else {
                // Start service
                commandService(serviceItem.dataset.service, 'start')
            }
            
            // Add visual feedback
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
}


function capitalizeFirstLetter(val) {
    return String(val).charAt(0).toUpperCase() + String(val).slice(1);
}

function showServices (services) {
    let html = ''

    for (service in services) {
        let name = capitalizeFirstLetter(service)
        let icon = services[service]['icon']
        let style = services[service]['style']
        let ss = services[service]['status']
        let command = services[service]['command']
        let status = capitalizeFirstLetter(ss)

        html += '<div class="service-item" data-service="' + service + '">';
        html += '    <div class="service-info">';
        html += '        <div class="service-icon" style="' + style + '">';
        html += '            <i class="' + icon + '"></i>';
        html += '        </div>';
        html += '        <div class="service-details">';
        html += '            <h4>' + service + '</h4>';
        html += '            <p>Status: <span class="status-' + ss + '">' + status + '</span></p>';
        html += '        </div>';
        html += '    </div>';
        html += '    <div class="service-controls">';

        if (command == '')  {
            if (status == 'Running') {
                html += '        <button class="btn btn-stop">';
                html += '            <i class="fas fa-stop"></i>';
                html += '            Stop';
                html += '        </button>';
            } else {
                html += '        <button class="btn btn-start">';
                html += '            <i class="fas fa-play"></i>';
                html += '            Start';
                html += '        </button>';
            }
        } else {
            if (command == 'start') {
                html += '            <span class="status-running">Starting ... </span>';
            } else if (command == 'stop') {
                html += '            <span class="status-stopped">Stoping ... </span>';
            } else if (command == 'restart') {
                html += '            <span class="status-process">Restarting ... </span>';
            }
        }

        html += '    </div>';
        html += '</div>';
    }

    document.querySelector('.service-list').innerHTML = html;
    addEvents()
}


function reloadServices() {
    if (wait) return false;

    let request = new XMLHttpRequest();
    let data = new URLSearchParams();

    request.open('POST','services.php', true);
    request.setRequestHeader('Content-type', 
        'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onload = function () {
        if (request.status === 200) {
            services = JSON.parse(request.response)
            showServices(services)
        } else {
            alert ('Internal error')
        }
    }
}

function commandService(service, command) {
    let request = new XMLHttpRequest();
    let data = new URLSearchParams();

    data.append('service', service);
    data.append('command', command);

    request.open('POST','services.php', true);
    request.setRequestHeader('Content-type', 
        'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onload = function () {
        if (request.status === 200) {
            services = JSON.parse(request.response)
            showServices(services)
        } else {
            alert ('Internal error')
        }
    }
}


setInterval(reloadServices, 2000)
reloadServices()
</script>