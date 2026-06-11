/**
 * Système de Validation JavaScript Avancée
 * Pour les formulaires de Gestion Bulletin CPET
 */

class FormValidator {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        this.errors = {};
        this.errorMessages = {
            required: 'Ce champ est obligatoire',
            email: 'Veuillez entrer une adresse email valide',
            min: (min) => `La valeur minimale est ${min}`,
            max: (max) => `La valeur maximale est ${max}`,
            minLength: (length) => `Minimum ${length} caractères requis`,
            maxLength: (length) => `Maximum ${length} caractères autorisés`,
            match: 'Les champs ne correspondent pas',
            number: 'Veuillez entrer un nombre valide',
            pattern: 'Le format est invalide',
            unique: 'Cette valeur est déjà utilisée',
            date: 'Veuillez entrer une date valide',
            fileSize: (size) => `La taille du fichier ne doit pas dépasser ${size}MB`,
            fileType: (types) => `Types acceptés: ${types.join(', ')}`,
            graduated: 'La note doit être entre 0 et 20'
        };

        if (this.form) {
            this.setupListeners();
        }
    }

    setupListeners() {
        // Validation en temps réel
        this.form.querySelectorAll('input, textarea, select').forEach(field => {
            field.addEventListener('blur', () => this.validateField(field));
            field.addEventListener('change', () => this.validateField(field));
        });

        // Validation du formulaire
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    validateField(field) {
        const fieldName = field.name;
        const value = field.value.trim();
        const rules = this.getFieldRules(field);

        this.errors[fieldName] = [];

        // Vérifications
        if (rules.required && !value) {
            this.errors[fieldName].push(this.errorMessages.required);
        }

        if (value) {
            if (rules.email && !this.isValidEmail(value)) {
                this.errors[fieldName].push(this.errorMessages.email);
            }

            if (rules.minLength && value.length < rules.minLength) {
                this.errors[fieldName].push(this.errorMessages.minLength(rules.minLength));
            }

            if (rules.maxLength && value.length > rules.maxLength) {
                this.errors[fieldName].push(this.errorMessages.maxLength(rules.maxLength));
            }

            if (rules.min && parseFloat(value) < rules.min) {
                this.errors[fieldName].push(this.errorMessages.min(rules.min));
            }

            if (rules.max && parseFloat(value) > rules.max) {
                this.errors[fieldName].push(this.errorMessages.max(rules.max));
            }

            if (rules.graduated && (parseFloat(value) < 0 || parseFloat(value) > 20)) {
                this.errors[fieldName].push(this.errorMessages.graduated);
            }

            if (rules.number && isNaN(parseFloat(value))) {
                this.errors[fieldName].push(this.errorMessages.number);
            }

            if (rules.date && !this.isValidDate(value)) {
                this.errors[fieldName].push(this.errorMessages.date);
            }

            if (rules.match) {
                const matchField = this.form.querySelector(`[name="${rules.match}"]`);
                if (matchField && matchField.value !== value) {
                    this.errors[fieldName].push(this.errorMessages.match);
                }
            }

            if (rules.pattern && !new RegExp(rules.pattern).test(value)) {
                this.errors[fieldName].push(this.errorMessages.pattern);
            }
        }

        this.displayFieldError(field);
        return this.errors[fieldName].length === 0;
    }

    getFieldRules(field) {
        return {
            required: field.hasAttribute('required'),
            email: field.type === 'email' || field.hasAttribute('data-email'),
            minLength: parseInt(field.getAttribute('minLength') || field.getAttribute('data-minlength') || 0),
            maxLength: parseInt(field.getAttribute('maxLength') || field.getAttribute('data-maxlength') || 0),
            min: parseFloat(field.getAttribute('min') || field.getAttribute('data-min') || -Infinity),
            max: parseFloat(field.getAttribute('max') || field.getAttribute('data-max') || Infinity),
            graduated: field.hasAttribute('data-graduated'),
            number: field.type === 'number' || field.hasAttribute('data-number'),
            date: field.type === 'date' || field.hasAttribute('data-date'),
            match: field.getAttribute('data-match'),
            pattern: field.getAttribute('pattern')
        };
    }

    displayFieldError(field) {
        const fieldName = field.name;
        let errorContainer = field.parentElement.querySelector('.error-message');

        // Supprimer les erreurs précédentes
        field.classList.remove('error');
        if (errorContainer) {
            errorContainer.remove();
        }

        // Afficher les nouvelles erreurs
        if (this.errors[fieldName].length > 0) {
            field.classList.add('error');

            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-red-500 text-sm mt-1';
            errorDiv.innerHTML = this.errors[fieldName].map(err => `• ${err}`).join('<br>');

            field.parentElement.appendChild(errorDiv);
        } else {
            field.classList.remove('error');
            if (value) {
                field.classList.add('success');
            }
        }
    }

    handleSubmit(e) {
        let isValid = true;

        this.form.querySelectorAll('input, textarea, select').forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
            this.showErrorMessage();
        }
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    isValidDate(dateString) {
        const date = new Date(dateString);
        return date instanceof Date && !isNaN(date);
    }

    showErrorMessage() {
        const toast = document.createElement('div');
        toast.className = 'toast error fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg';
        toast.innerHTML = `
            <div class="flex items-center gap-2">
                <span>❌</span>
                <span>Veuillez corriger les erreurs du formulaire</span>
            </div>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideOut 0.5s ease-out forwards';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    // Méthode pour valider les notes (0-20)
    static validateGrade(grade) {
        const num = parseFloat(grade);
        return !isNaN(num) && num >= 0 && num <= 20;
    }

    // Méthode pour formater une note
    static formatGrade(grade) {
        const num = parseFloat(grade);
        if (isNaN(num)) return '';
        return Math.min(Math.max(num, 0), 20).toFixed(2);
    }

    // Validateur de date d'absence (pas de date future)
    static validateAbsenceDate(dateString) {
        const date = new Date(dateString);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        return date <= today;
    }
}

// CSS pour les champs avec erreurs
const style = document.createElement('style');
style.textContent = `
    input.error,
    textarea.error,
    select.error {
        border-color: #DC2626 !important;
        background-color: #FEE2E2 !important;
    }

    input.success,
    textarea.success,
    select.success {
        border-color: #10B981 !important;
        background-color: #ECFDF5 !important;
    }

    .error-message {
        display: block;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }
`;
document.head.appendChild(style);

// Initialisation automatique pour tous les formulaires avec data-validate
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form[data-validate]').forEach(form => {
        new FormValidator('form[data-validate]');
    });
});
