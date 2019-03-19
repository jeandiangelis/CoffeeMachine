composer create-project symfony/skeleton coffeemachine
cd coffeemachine
git init
git add --all
git commit -m "Initial Commit"
git remote add origin ssh://git@bitbucket.check24.de:7999/~eugen.ganshorn/coffeemachine.git
composer require maker --dev
composer require annotations
