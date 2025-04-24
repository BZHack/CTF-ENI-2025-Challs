# Write-Up: La Maison Hantée

## Description du Challenge

Ce challenge est un binaire dans lequel le joueur doit invoquer un fantôme en entrant la bonne phrase. Lorsque l’invocation correcte est saisie, le drapeau est révélé.

Le programme contient une chaîne de caractères qui donne une indication sur la phrase à entrer.

Le drapeau est chiffré avec un simple XOR et ne peut être obtenu que si le programme le déchiffre correctement.

---

## Challenge.yml

Le fichier `challenge.yml` est utilisé pour déployer le challenge dans un environnement CTF. Il contient les informations essentielles comme le nom, l’auteur, la catégorie, la description, le flag, les fichiers et les indices.

---

## Résolution

### 1. **Identifier la phrase d’invocation**

La première étape consiste à analyser le binaire pour trouver la phrase à entrer. Pour cela, la commande `strings` sur Linux suffit :

```bash
strings foundGhost | grep Invocation
```

Cela retourne :

```bash
Invocation =J'invoque le fantome de ces lieux !
```

On comprend alors que la phrase correcte à entrer est :
```
J'invoque le fantome de ces lieux !
```

### 2. **Lancer le programme et invoquer le fantôme**

Exécutez le binaire :
```bash
./foundGhost
```
Lorsque le programme demande d’entrer une phrase, saisissez :
```
J'invoque le fantome de ces lieux !
```
Si la phrase est correcte, le fantôme est révélé et le drapeau est affiché après avoir été déchiffré.





### 3. Bonus **Extraire le drapeau en analysant le XOR**

Le drapeau est chiffré en dur dans le binaire avec un XOR simple. Si on souhaite le retrouver sans invoquer le fantôme, on peut l’extraire depuis le code source :

```c
unsigned char encrypted_flag[] = { 0x1F, 0x14, 0x13, 0x21, 0x16, 0x3F, 0x1C, 0x6E, 0x14, 0x2E, 0x99, 0xCE, 0x17, 0x3F, 0x9, 0x3F, 0x8, 0x3F, 0xC, 0x3F, 0x16, 0x3F, 0x27 };
#define XOR_KEY 0x5A
```

On peut recoder une fonction en C pour appliquer le XOR et récupérer le drapeau :

```c
#include <stdio.h>
#define XOR_KEY 0x5A

void decrypt_flag(const unsigned char *encrypted_flag, size_t len) {
    char decrypted_flag[len + 1];
    for (size_t i = 0; i < len; i++) {
        decrypted_flag[i] = encrypted_flag[i] ^ XOR_KEY;
    }
    decrypted_flag[len] = '\0';
    printf("Drapeau : %s\n", decrypted_flag);
}

int main() {
    unsigned char encrypted_flag[] = { 0x1F, 0x14, 0x13, 0x21, 0x16, 0x3F, 0x1C, 0x6E, 0x14, 0x2E, 0x99, 0xCE, 0x17, 0x3F, 0x9, 0x3F, 0x8, 0x3F, 0xC, 0x3F, 0x16, 0x3F, 0x27 };
    decrypt_flag(encrypted_flag, sizeof(encrypted_flag));
    return 0;
}
```


On peut aussi utiliser un script Python pour le déchiffrer :

```python
encrypted_flag = [0x1F, 0x14, 0x13, 0x21, 0x16, 0x3F, 0x1C, 0x6E, 0x14, 0x2E, 0x99, 0xCE, 0x17, 0x3F, 0x9, 0x3F, 0x8, 0x3F, 0xC, 0x3F, 0x16, 0x3F, 0x27]
xor_key = 0x5A
decrypted_flag = "".join(chr(c ^ xor_key) for c in encrypted_flag)
print("Drapeau :", decrypted_flag)
```

L’exécution de ce script affichera le drapeau en clair.

---

## Hints
1. **Inspectez le binaire à la recherche d'indices**
2. **Utilisez un commande linux pour inspecter les chaiens de caractères du binaire**
3. **Regardez bien la sortie de `strings`, une ligne contient `Invocation =` et peut donner une bonne indication.**
4. **Essayez d'entrer la phrase trouvée dans le programme pour voir si cela déclenche quelque chose.**
5. **Si vous voulez extraire le drapeau sans exécuter le programme, pensez à analyser les données stockées et à appliquer un XOR sur la chaîne chiffrée.**

---

## Conclusion

Ce challenge est une bonne introduction à l’analyse statique d’un binaire avec `strings`, ainsi qu’à l’utilisation du chiffrement XOR simple pour masquer un drapeau. L’approche la plus rapide est de retrouver la phrase correcte avec `strings` et de l’entrer dans le programme, mais une analyse plus approfondie permet d’extraire et de déchiffrer le drapeau sans exécuter le programme.

Drapeau : **ENI{LeF4NtÔMeSeReVeLe}**
