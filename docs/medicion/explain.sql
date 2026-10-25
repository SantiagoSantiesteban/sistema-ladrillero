EXPLAIN SELECT * FROM users WHERE role='trabajador' OR role='dual'\G
EXPLAIN SELECT * FROM disponibilidades WHERE lunes=1 AND miercoles=1\G
EXPLAIN SELECT * FROM users WHERE email='sint_25000@test.local' LIMIT 1\G
EXPLAIN SELECT role, COUNT(*) AS total FROM users GROUP BY role\G
