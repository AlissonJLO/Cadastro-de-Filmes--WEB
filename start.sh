#!/bin/bash
# start.sh

# Cores...
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m'

# Variáveis de Configuração
DB_CONTAINER_NAME="ap1_postgres_db"
DB_USER='postgres'
DB_NAME='ap1_filmes'
export PGPASSWORD='postgres'

# Funções
function start_db() {
    echo -e "${GREEN}==> Subindo o container do PostgreSQL...${NC}"
    docker compose up -d

    echo -e "${CYAN}==> Aguardando o PostgreSQL ficar pronto...${NC}"
    timeout=60
    until docker exec "$DB_CONTAINER_NAME" pg_isready -U "$DB_USER" -d "$DB_NAME" -q || [ $timeout -eq 0 ]; do
      echo -e "Aguardando... ($timeout s)"
      sleep 1
      timeout=$((timeout-1))
    done

    if [ $timeout -eq 0 ]; then
        echo -e "${YELLOW}Timeout: O PostgreSQL não ficou pronto a tempo.${NC}"; exit 1;
    fi

    echo -e "${GREEN}==> PostgreSQL está pronto!${NC}"
    echo -e "${CYAN}==> Executando o script 'database.sql'...${NC}"

    # **CORRIGIDO**: Adicionado -v ON_ERROR_STOP=1
    cat database.sql | docker exec -i "$DB_CONTAINER_NAME" psql -U "$DB_USER" -d "$DB_NAME" -v ON_ERROR_STOP=1

    if [ $? -eq 0 ]; then
        echo -e "${GREEN}==> Script 'database.sql' executado com sucesso! O banco está pronto.${NC}"
    else
        echo -e "${YELLOW}==> Ocorreu um erro ao executar o 'database.sql'. Verifique os logs acima.${NC}"
    fi
}

function stop_db() {
    echo -e "${YELLOW}==> Parando e removendo o container...${NC}"
    # Nota: Usamos 'down' sem '--volumes' para que o script idempotente funcione.
    # Se quiser um reset total, use 'docker compose down --volumes' manualmente.
    docker compose down
    echo -e "${YELLOW}==> Container parado.${NC}"
}

function show_help() {
    echo "Uso: ./start.sh [OPÇÃO]"
    echo "Opções:"
    echo "  (sem opção)   Inicia o container e aplica o script SQL."
    echo "  -s, --stop    Para e remove o container (mantém os dados)."
    echo "  -h, --help    Mostra esta ajuda."
}

# Lógica Principal
case "$1" in
    -s|--stop) stop_db ;;
    -h|--help) show_help ;;
    *) start_db ;;
esac

unset PGPASSWORD