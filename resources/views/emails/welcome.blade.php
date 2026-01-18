<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #ec4899; padding-bottom: 20px; margin-bottom: 20px; }
        .btn { display: inline-block; background-color: #ec4899; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #333;">⚽ Hola, {{ $user->name }}!</h1>
        </div>
        
        <p>Gràcies per registrar-te a l'aplicació oficial de la <strong>Lliga de Futbol Femení</strong>.</p>
        
        <p>Ara ja pots accedir al panell de control per veure:</p>
        <ul>
            <li>La classificació en temps real.</li>
            <li>Les fitxes de les jugadores.</li>
            <li>El calendari de partits.</li>
        </ul>

        <div style="text-align: center;">
            <a href="{{ route('dashboard') }}" class="btn">Accedir al Panell</a>
        </div>

        <div class="footer">
            <p>Gràcies per confiar en nosaltres.</p>
        </div>
    </div>
</body>
</html>