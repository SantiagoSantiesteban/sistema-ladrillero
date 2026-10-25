NF>=3 { q=$3; d=$2*1000;
  if (q ~ /GROUP BY/) k="Q4 contar por rol";
  else if (q ~ /lunes/) k="Q2 disponibles lunes+miercoles";
  else if (q ~ /email/) k="Q3 usuario por email";
  else if (q ~ /OR role/) k="Q1 trabajadores por rol";
  else next;
  s[k]+=d; n[k]++ }
END { for (k in s) printf "%s\t%d reps\t%.3f ms\n", k, n[k], s[k]/n[k] }
