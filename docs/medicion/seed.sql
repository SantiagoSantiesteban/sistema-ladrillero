INSERT INTO users (name,email,password,role,es_empleador,telefono,created_at,updated_at)
SELECT CONCAT('Sint ',seq), CONCAT('sint_',seq,'@test.local'), 'x',
       CASE WHEN seq%20<14 THEN 'trabajador' WHEN seq%20=14 THEN 'dual' ELSE 'empleador' END,
       IF(seq%20>=14,1,0), CONCAT('300',LPAD(seq,7,'0')), NOW(), NOW()
FROM seq_1_to_50000;
INSERT INTO disponibilidades (user_id,lunes,martes,miercoles,jueves,viernes,sabado,domingo,created_at,updated_at)
SELECT id, RAND()<0.4, RAND()<0.4, RAND()<0.4, RAND()<0.4, RAND()<0.4, RAND()<0.2, RAND()<0.1, NOW(), NOW()
FROM users WHERE role IN ('trabajador','dual');
ANALYZE TABLE users, disponibilidades;
