import binascii
import math

def gcd(a, b):
    return math.gcd(a, b)

def iterative_egcd(a, b):
    x0, x1, y0, y1 = 1, 0, 0, 1
    while b != 0:
        q, a, b = a // b, b, a % b
        x0, x1 = x1, x0 - q * x1
        y0, y1 = y1, y0 - q * y1
    return a, x0, y0

def modinv(a, m):
    g, x, y = iterative_egcd(a, m)
    if g != 1:
        raise ValueError('Modular inverse does not exist.')
    else:
        return x % m

def rsa_common_modulus_attack(c1, c2, e1, e2, N):
    if gcd(e1, e2) != 1:
        raise ValueError("Exponents e1 et e2 doivent être coprimes")
    s1 = modinv(e1, e2)
    s2 = (gcd(e1, e2) - e1 * s1) // e2
    temp = modinv(c2, N)
    m1 = pow(c1, s1, N)
    m2 = pow(temp, -s2, N)
    return (m1 * m2) % N

def decrypt_fragments(encrypted_fragments, e1, e2, n):
    decrypted_message = b''

    for c1, c2 in encrypted_fragments:
        message_decrypted = rsa_common_modulus_attack(c1, c2, e1, e2, n)
        fragment_bytes = binascii.unhexlify(format(message_decrypted, 'x'))
        decrypted_message += fragment_bytes

    return decrypted_message

def main():
    print('[RSA - Déchiffrement des fragments chiffrés]')

    # Paramètres RSA
    e1 = 13
    e2 = 11
    n = 23952937352643527451379227516428377705004894508566304313177880191662177061878993798938496818120987817049538365206671401938265663712351239785237507341311858383628932183083145614696585411921662992078376103990806989257289472590902167457302888198293135333083734504191910953238278860923153746261500759411620299864395158783509535039259714359526738924736952759753503357614939203434092075676169179112452620687731670534906069845965633455748606649062394293289967059348143206600765820021392608270528856238306849191113241355842396325210132358046616312901337987464473799040762271876389031455051640937681745409057246190498795697239 

    # Lecture des fragments chiffrés à partir du fichier
    encrypted_fragments = []
    with open("encrypted_fragments.txt", "r") as f:
        for line in f:
            c1_hex, c2_hex = line.strip().split(',')
            c1 = int(c1_hex, 16)
            c2 = int(c2_hex, 16)
            encrypted_fragments.append((c1, c2))

    print(f'\n[+] Décryptage de {len(encrypted_fragments)} fragments.')

    # Déchiffrer les fragments
    try:
        decrypted_message = decrypt_fragments(encrypted_fragments, e1, e2, n)
        print('\n[+] Déchiffrement terminé:')
        print(decrypted_message.decode('utf-8'))
    except Exception as e:
        print(f'[-] Déchiffrement échoué : {e}')

if __name__ == "__main__":
    main()

