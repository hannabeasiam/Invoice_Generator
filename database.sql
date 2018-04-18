DROP DATABASE IF EXISTS invoices;
CREATE DATABASE IF NOT EXISTS invoices;
USE invoices;

CREATE TABLE invoice_header (
  invoice_number VARCHAR(10)  PRIMARY KEY,
  customer_name  VARCHAR(30)  NOT NULL
);
CREATE TABLE invoice_details (
  invoice_detail_id     INT              PRIMARY KEY AUTO_INCREMENT,
  invoice_number        VARCHAR(10),
  invoice_description   TEXT             NOT NULL,
  quantity              INT(4)           NOT NULL,
  price                 DECIMAL(9,2)     NOT NULL,
  FOREIGN KEY  (invoice_number) REFERENCES invoice_header(invoice_number)
);