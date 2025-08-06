#observe a configuração no phpunit.xml
#foi comentada a tag que chama ./tests/Feature/ sobrando apenas ./tests/Unit/ tornadno desnecessários os comandos comentados.


#teste unitário padrão
#./vendor/bin/phpunit ./tests

#ignorando um grupo
#./vendor/bin/phpunit ./tests/Unit --exclude-group ignored

#teste verboso:
echo "

Rodando testes em ./tests/Unit/:
"
php artisan test