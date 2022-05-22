USE horrienewsdb;

CREATE USER IF NOT EXISTS horrienewsdbuser@localhost
IDENTIFIED BY 'horrienewsdbuser';

GRANT ALL PRIVILEGES ON horrienewsdb.* TO horrienewsdbuser@localhost;