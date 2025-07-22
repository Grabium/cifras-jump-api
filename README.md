<h1 align="center">CifrasJump-API</h1>
<h3 align="center"><em>ESTAMOS EM CONSTRUÇÃO!</em></h3><br />
<p>CifrasJump é uma web API (atualmente em desenvolvimento) que recebe um conteúdo textual e converte as partes detectadas como cifras musicais, se houverem, para a tonalidade desejada, baseado na quantidade de semi-tons no corpo da requisição.</p>
<h2 align="left">Introdução</h2>
<p>Envie a requisição para o end-point: <strong>/api/main</strong> :</p>

_Requisição_
```html
Method:"post"
fator:"5"
texto:"
 A     D/A
Não dá     mais pra negar
E/A                   C#m7  A  E/G#  F#m
    O mar é Deus e o barco sou eu"
```
E obtenha como resposta o texto com a tonalidade 5 semi-tons acima (lá + 5 ST = ré):

_Resposta_
```html
texto:"
 D     G/D
Não dá     mais pra negar
A/D                   F#m7  D  A/C#  Bm
    O mar é Deus e o barco sou eu"
```

- texto: É o campo com conteúdo textual que terá a tonalidade convertida;
- fator: É o campo com contendo um número inteiro entre -11 e 11, incluindo o 0 (zero), que representará a quantidade de semi-tons a ser alterada no texto. Podendo subir ou descer. O zero não altera o texto.

<h2>Tipos de acordes que podem ser capturados para a conversão</h2>
<p>Eis a lista contendo apenas o A (lá), mas considere os demais (B, C, D, E, F, G,):</p>

- A
- Am
- A#
- Ab
- A#m
- Abm
- A/G ou qualquer outro acima já citado com inversão.
