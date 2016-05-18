help:
	@echo "build - Build Docker image"
	@echo "run - Start Docker container listening to port 50505"
	@echo "shell - Start a bash shell in the running container."
	@echo "clean - Stop and remove Docker container."

build:
	docker build -t webctf .

run:
	docker run -dit -p 50505:80 --name=webctf-container webctf

shell:
	docker exec -i -t webctf-container /bin/bash

clean:
	docker stop webctf-container; docker rm webctf-container
