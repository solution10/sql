all: clean apidocs

apidocs:
	vendor/bin/apigen.php --source src/ --destination api/ --exclude="*/Tests/*"

test-unit:
	vendor/bin/phpunit

test-unit-coverage:
	vendor/bin/phpunit --coverage-html report
	open ./report/index.html

clean:
	rm -rf api/*
