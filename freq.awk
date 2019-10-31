#Se declara la variable inicial con todos los caracteres
BEGIN { FS="" }
#Se genera un arreglo y se colocan todos los carateres en él
      { for(i=1;i<=NF;i++) freq[$i]++}
#Se imprime el conteo de los caracteres del arreglo
END   { for(i in freq) printf("%8d %-14s\n", freq[i],i)}
