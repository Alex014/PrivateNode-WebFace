<section class="cpanel-section">
    <h2 class="section-title">System</h2>
    <div class="system-actions">
        <div class="action-card">
            <div class="action-icon cert-icon">
                <i class="fas fa-certificate"></i>
            </div>
            <h4>Regenerate Certificate</h4>
            <p>Generate a new SSL certificate for enhanced security and encryption.</p>
            <button class="btn btn-primary" data-command="cert">
                <i class="fas fa-sync-alt"></i>
                Regenerate
            </button>
        </div>
        
        <div class="action-card">
            <div class="action-icon upgrade-icon">
                <i class="fas fa-arrow-up"></i>
            </div>
            <h4>Full System Upgrade</h4>
            <p>Update all system components to the latest versions with security patches.</p>
            <button class="btn btn-secondary" data-command="sysupgrade">
                <i class="fas fa-download"></i>
                Upgrade System
            </button>
        </div>
    </div>
</section>

<section class="cpanel-section">
    <h2 class="section-title">Change User Password</h2>
    <div class="password-form user-form">

        <div class="form-group">
            <label for="user-password">User Password</label>
            <input type="password" id="user-password" class="form-control" placeholder="Enter new privateness user password">
            <input type="password" class="form-control" placeholder="Confirm new privateness user password">
        </div>

        <button class="btn-submit user">
            <i class="fas fa-key"></i>
            Update Password
        </button>
    </div>
</section>

<section class="cpanel-section">
    <h2 class="section-title">Change Root Password</h2>
    <div class="password-form root-form">
        
        <div class="form-group">
            <label for="root-password">Root Password</label>
            <input type="password" id="root-password" class="form-control" placeholder="Enter new root password">
            <input type="password" class="form-control" placeholder="Confirm new root password">
        </div>
        
        <button class="btn-submit root">
            <i class="fas fa-key"></i>
            Update Password
        </button>
    </div>
</section>

<script>
// System actions
const regenerateBtn = document.querySelector('.btn-primary');
const upgradeBtn = document.querySelector('.btn-secondary');

// Password form submission
const userForm = document.querySelector('.user-form');
const userPass = userForm.querySelectorAll('input')[0];
const userPassConfirm = userPass.nextElementSibling
const userBtn = userForm.querySelectorAll('button')[0];

const rootForm = document.querySelector('.root-form');
const rootPass = rootForm.querySelectorAll('input')[0];
const rootPassConfirm = rootPass.nextElementSibling
const rootBtn = rootForm.querySelectorAll('button')[0];

let WAIT = false;

regenerateBtn.addEventListener('click', function() {
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Regenerating...';
    this.disabled = true;
    
    commandSystem(this.dataset.command)
});

upgradeBtn.addEventListener('click', function() {
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Upgrading...';
    this.disabled = true;
    
    commandSystem(this.dataset.command)
});

userBtn.addEventListener('click', function() {
    if (userPass.value.length < 5) {
        userBtn.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Password length must be more or equal 5 <i class="fa-solid fa-triangle-exclamation"></i> ';

        WAIT = true;
        setTimeout(function () {
            userBtn.innerHTML = '<i class="fas fa-key"></i> Update Password';
            WAIT = false;
        }, 5000)

        return false
    } else if (userPass.value != userPassConfirm.value) {
        userBtn.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Passwords do not match <i class="fa-solid fa-triangle-exclamation"></i> ';

        WAIT = true;
        setTimeout(function () {
            userBtn.innerHTML = '<i class="fas fa-key"></i> Update Password';
            WAIT = false;
        }, 5000)
        
        return false
    }

    commandSystem('userpass', userPass.value)

    // Clear form fields
    const inputs = userForm.querySelectorAll('input');
    inputs.forEach(input => {
        input.value = '';
    });
});

rootBtn.addEventListener('click', function() {
    if (rootPass.value.length < 5) {
        rootBtn.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Password length must be more or equal 5 <i class="fa-solid fa-triangle-exclamation"></i> ';

        WAIT = true;
        setTimeout(function () {
            rootBtn.innerHTML = '<i class="fas fa-key"></i> Update Password';
            WAIT = false;
        }, 5000)

        return false
    } else if (rootPass.value != rootPassConfirm.value) {
        rootBtn.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Passwords do not match <i class="fa-solid fa-triangle-exclamation"></i> ';

        WAIT = true;
        setTimeout(function () {
            rootBtn.innerHTML = '<i class="fas fa-key"></i> Update Password';
            WAIT = false;
        }, 5000)
        
        return false
    }

    commandSystem('rootpass', rootPass.value)

    // Clear form fields
    const inputs = userForm.querySelectorAll('input');
    inputs.forEach(input => {
        input.value = '';
    });
});

function showSystem (commands) {
    for (command in commands) {
        let ss = commands[command]['status']
        let dt = commands[command]['date']

        if (command == 'cert') {
            if (ss == 'iddle') {    
                regenerateBtn.innerHTML = '<i class="fas fa-sync-alt"></i> Regenerate';
                regenerateBtn.disabled = false;
            } else if (ss == 'launch' || ss == 'running') {
                regenerateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Regenerating...';
                regenerateBtn.disabled = true;
            } else if (ss == 'done') {
                regenerateBtn.innerHTML = '<i class="fas fa-sync-alt"></i> New certificate generated ' + dt;
                regenerateBtn.disabled = false;
            }
        } else if (command == 'sysupgrade') {
            if (ss == 'iddle') {
                upgradeBtn.innerHTML = '<i class="fas fa-download"></i> Upgrade System';
                upgradeBtn.disabled = false;
            } else if (ss == 'launch' || ss == 'running') {
                upgradeBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Upgrading...';
                upgradeBtn.disabled = true;
            } else if (ss == 'done') {
                upgradeBtn.innerHTML = '<i class="fas fa-check"></i> System upgraded ' + dt;
                regenerateBtn.disabled = false;
            }
        } else if (command == 'userpass') {
            if (ss == 'iddle') {
                userBtn.innerHTML = '<i class="fas fa-key"></i> Update Password';
                userBtn.disabled = false;
            } else if (ss == 'launch' || ss == 'running') {
                userBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                userBtn.disabled = true;
            } else if (ss == 'done') {
                userBtn.innerHTML = '<i class="fas fa-check"></i> Password Updated ' + dt;
                userBtn.disabled = false;
            }
        } else if (command == 'rootpass') {
            if (ss == 'iddle') {
                rootBtn.innerHTML = '<i class="fas fa-key"></i> Update Password';
                rootBtn.disabled = false;
            } else if (ss == 'launch' || ss == 'running') {
                rootBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                rootBtn.disabled = true;
            } else if (ss == 'done') {
                rootBtn.innerHTML = '<i class="fas fa-check"></i> Password Updated ' + dt;
                rootBtn.disabled = false;
            }
        }
    }
}


function reloadSystem() {
    if (WAIT) return false;

    let request = new XMLHttpRequest();
    let data = new URLSearchParams();

    request.open('POST','commands.php', true);
    request.setRequestHeader('Content-type', 
        'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onload = function () {
        if (request.status === 200) {
            system = JSON.parse(request.response)
            showSystem(system)
        } else {
            alert ('Internal error')
        }
    }
}

function commandSystem(command, param=false) {
    let request = new XMLHttpRequest();
    let data = new URLSearchParams();

    data.append('command', command);

    if (param != false) {
        data.append('param', param);
    }

    request.open('POST','commands.php', true);
    request.setRequestHeader('Content-type', 
        'application/x-www-form-urlencoded; charset=UTF-8');

    request.send(data);

    request.onload = function () {
        if (request.status === 200) {
            system = JSON.parse(request.response)
            showSystem(system)
        } else {
            alert ('Internal error')
        }
    }
}


setInterval(reloadSystem, 2000)
reloadSystem()
</script>