#!/bin/sh


## Antes que nada hay q guardar las credenciales de github 
## Ejecutando: git config credential.helper store


ROUTE_TO_GIT_PROJECT="./../"
LOG="./git.log"
NOW=$(date +"%Y-%m-%d-%H%M%S")

## Start script:
echo "
--------------------------------------------------------
NEW DEPLOYMENT: $NOW
" >> $LOG
cd $ROUTE_TO_GIT_PROJECT >> $LOG
git checkout master >> $LOG
git clean -df >> $LOG
git checkout -- . >> $LOG
git pull >> $LOG

echo "End Deploy." >> $LOG


