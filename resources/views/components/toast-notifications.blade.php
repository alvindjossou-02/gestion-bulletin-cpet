@if(session('success'))
    <div class="toast-container">
        <div class="toast success" data-toast>
            <span class="toast-icon">✓</span>
            <span class="toast-message">{{ session('success') }}</span>
            <button class="toast-close" onclick="this.parentElement.classList.add('removing'); setTimeout(() => this.parentElement.remove(), 300)">×</button>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.querySelector('[data-toast]');
            if (toast) {
                toast.classList.add('removing');
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    </script>
@endif

@if(session('error'))
    <div class="toast-container">
        <div class="toast error" data-toast>
            <span class="toast-icon">!</span>
            <span class="toast-message">{{ session('error') }}</span>
            <button class="toast-close" onclick="this.parentElement.classList.add('removing'); setTimeout(() => this.parentElement.remove(), 300)">×</button>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.querySelector('[data-toast]');
            if (toast) {
                toast.classList.add('removing');
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    </script>
@endif

@if(session('status'))
    <div class="toast-container">
        <div class="toast info" data-toast>
            <span class="toast-icon">ℹ</span>
            <span class="toast-message">{{ session('status') }}</span>
            <button class="toast-close" onclick="this.parentElement.classList.add('removing'); setTimeout(() => this.parentElement.remove(), 300)">×</button>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.querySelector('[data-toast]');
            if (toast) {
                toast.classList.add('removing');
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    </script>
@endif
