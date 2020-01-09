RSYNC_CMD = rsync -avz --delete --no-perms
RSYNC_CMD += --exclude '.git*'
RSYNC_CMD += --exclude Makefile
RSYNC_CMD += --exclude node_modules

RSYNC_CMD_UPLOAD = rsync -avz --delete --no-perms

prod:
	${RSYNC_CMD} . michelre@51.38.50.145:/data/poc-storage
