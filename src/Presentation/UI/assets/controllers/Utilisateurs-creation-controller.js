import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        document.getElementById('user-form').addEventListener('submit', this.submit.bind(this));
    }

    async submit(e) {
        e.preventDefault();
        const data = {
            nom: document.getElementById('nom').value,
            prenom: document.getElementById('prenom').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        };

        const response = await fetch('/api/utilisateurs', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        const div = document.getElementById('result');

        if (response.ok) {
            div.innerHTML = `<div class="alert alert-success">✅ ${result.message} (ID: ${result.id})</div>`;
        } else if (response.status === 429) {
            div.innerHTML = `<div class="alert alert-warning">⏳ ${result.message || 'Rate limit atteint (Redis)'}</div>`;
        } else {
            div.innerHTML = `<div class="alert alert-danger">❌ ${result.error || JSON.stringify(result)}</div>`;
        }
    }
}