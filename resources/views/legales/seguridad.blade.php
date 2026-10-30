<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Políticas de Seguridad y Privacidad de la Información</h1>
        <div class="prose text-gray-600">
            <p><strong>1. Marco Legal:</strong> En cumplimiento de la Ley 1581 de 2012 y normativas concordantes en Colombia, LadrilloWeb garantiza la protección y el manejo adecuado de los datos personales de sus usuarios.</p>
            <p><strong>2. Recopilación y Uso de Datos:</strong> Capturamos información básica (nombre, teléfono, correo electrónico, rol y días de disponibilidad) con el único propósito de habilitar el emparejamiento laboral. Los datos de contacto de los trabajadores solo son visibles para empleadores registrados.</p>
            <p><strong>3. Medidas de Seguridad de la Información:</strong> Para proteger la integridad de la plataforma, LadrilloWeb implementa:</p>
            <ul class="list-disc pl-5">
                <li><strong>Cifrado de Credenciales:</strong> Las contraseñas se almacenan mediante algoritmos de encriptación (Bcrypt), impidiendo su lectura directa.</li>
                <li><strong>Control de Acceso (Middleware):</strong> El sistema cuenta con validación estricta de roles, impidiendo que usuarios no autorizados accedan a rutas administrativas o manipulen información de otros perfiles.</li>
                <li><strong>Protección contra Vulnerabilidades:</strong> Implementamos cabeceras HTTP de seguridad (SecurityHeaders) para mitigar riesgos de red como Clickjacking o Inyecciones de Código, validado mediante auditorías con OWASP ZAP.</li>
            </ul>
            <p><strong>4. Derechos del Titular:</strong> Todo usuario tiene derecho a conocer, actualizar, rectificar o eliminar su información personal directamente desde su panel de control o solicitándolo a la administración del sistema.</p>
        </div>
    </div>
</x-app-layout>