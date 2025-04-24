#include <stdio.h>
#include <openssl/conf.h>
#include <openssl/evp.h>
#include <openssl/err.h>
#include <string.h>
#include <stdbool.h>

void handleErrors(void) {
    ERR_print_errors_fp(stderr);
    abort();
}

int affiche_flag(unsigned char *ciphertext, int ciphertext_len, unsigned char *key,
            unsigned char *iv, unsigned char *plaintext) {
    EVP_CIPHER_CTX *ctx;

    int len;
    int plaintext_len;

    // Créer un nouveau contexte de déchiffrement
    if(!(ctx = EVP_CIPHER_CTX_new())) handleErrors();

    // Initialiser le déchiffrement avec AES-256-CBC
    if(1 != EVP_DecryptInit_ex(ctx, EVP_aes_256_cbc(), NULL, key, iv))
        handleErrors();

    // Déchiffrer le texte chiffré
    if(1 != EVP_DecryptUpdate(ctx, plaintext, &len, ciphertext, ciphertext_len))
        handleErrors();
    plaintext_len = len;

    // Finaliser le déchiffrement
    if(1 != EVP_DecryptFinal_ex(ctx, plaintext + len, &len)) handleErrors();
    plaintext_len += len;

    // Libérer le contexte
    EVP_CIPHER_CTX_free(ctx);

    return plaintext_len;
}

int main() {
   volatile bool true_ou_false = true;
   if (true_ou_false){
      printf("Michael Myers rôde toujours...\n");
   }
   else{
      printf("Il a disparu dans l'ombre... mais il a laissé quelque chose derrière lui.\n");

      // Texte chiffré (doit correspondre à la sortie du chiffrement précédent)
      unsigned char ciphertext[] = {
       0xe8, 0x45, 0x0c, 0x17, 0xf3, 0x81, 0xa4, 0x19,
       0x86, 0xd7, 0x34, 0x23, 0x58, 0x28, 0xe1, 0x1f,
       0xcc, 0xb7, 0x57, 0x22, 0x35, 0xdc, 0x81, 0xeb,
       0x29, 0x94, 0x61, 0x34, 0xb2, 0xe4, 0xa0, 0x4d
      };
      // Clé et IV (doivent être les mêmes que ceux utilisés pour le chiffrement)
      unsigned char *key = (unsigned char *)"80814887308195301173191128120471";
      unsigned char *iv = (unsigned char *)"4726785580710492";

      // Buffer pour le texte déchiffré
      unsigned char decryptedtext[128];

      int decryptedtext_len;
      // Déchiffrer la chaîne
      decryptedtext_len = affiche_flag(ciphertext, sizeof(ciphertext), key, iv, decryptedtext);

      // Ajouter un caractère nul pour afficher la chaîne
      decryptedtext[decryptedtext_len] = '\0';

      // Afficher le texte déchiffré
      printf("Le flag est %s\n", decryptedtext);
   }
   return 0;
}
