SELECT SQL_NO_CACHE * FROM users WHERE role='trabajador' OR role='dual';
SELECT SQL_NO_CACHE * FROM disponibilidades WHERE lunes=1 AND miercoles=1;
SELECT SQL_NO_CACHE * FROM users WHERE email='sint_25000@test.local' LIMIT 1;
SELECT SQL_NO_CACHE role, COUNT(*) AS total FROM users GROUP BY role;
