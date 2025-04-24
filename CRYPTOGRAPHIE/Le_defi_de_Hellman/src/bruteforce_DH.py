p = 2457653467875423
g = 5
A = 2011535723318929
B = 691502255880305

def calculusSecret(cle_public, cle_privee, valeur_p):
	return (cle_public**cle_privee)%valeur_p

def calculusPublicKey(valeur_g, cle_privee, valeur_p):
	return (valeur_g**cle_privee)%valeur_p

for i in range (0,1000):
	if calculusPublicKey(g, i, p) == A:
		secret = calculusSecret(B, i, p)
		print("Secret : ", secret)
		break


