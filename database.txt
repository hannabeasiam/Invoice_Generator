DROP DATABASE IF EXISTS invoices;
CREATE DATABASE IF NOT EXISTS invoices;
USE invoices;

CREATE TABLE invoice_header (
  invoice_id     INT          PRIMARY KEY   AUTO_INCREMENT,
  invoice_number VARCHAR(10)  NOT NULL      UNIQUE,
  customer_name  VARCHAR(30)  NOT NULL
);
CREATE TABLE invoice_details (
  invoice_detail_id     INT              PRIMARY KEY AUTO_INCREMENT,
  invoice_id            INT,
  invoice_description   TEXT             NOT NULL,
  quantity              INT(4)           NOT NULL,
  price                 DECIMAL(9,2)     NOT NULL,
  item                  VARCHAR(20)      NOT NULL,
  FOREIGN KEY  (invoice_id) REFERENCES invoice_header(invoice_id)
);