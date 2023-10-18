<h1>DiplomaSucces</h1>
<p>Geachte {{ $user->name }},</p>
<br>
<p>Een docent heeft een account voor u aangemaakt. U kunt deze activeren via de onderstaande knop.</p>
<a href="http://localhost:8000/wachtwoord?code={{ $user->reset_token }}">Klik hier</a>
<br>
<p>Met vriendelijke groet,</p>
<p>DiplomaSucces</p>