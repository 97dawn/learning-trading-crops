DROP DATABASE IF EXISTS fpdb;

CREATE DATABASE fpdb;

GRANT ALL PRIVILEGES ON fpdb.* to root@localhost IDENTIFIED BY 'root';

USE fpdb;
CREATE TABLE MEMBERS (
	username VARCHAR(254) NOT NULL,
    pw VARCHAR(254) NOT NULL,
    memberType VARCHAR(254) NOT NULL,
    PRIMARY KEY (username)
);

CREATE TABLE CITIES(
    city VARCHAR(254) NOT NULL,
    province VARCHAR(254) NOT NULL,
    PRIMARY KEY (city)
);

CREATE TABLE BUYERS (
    bid VARCHAR(254) NOT NULL,
    fName VARCHAR(254) NOT NULL,
	  lName VARCHAR(254) NOT NULL,
    phone VARCHAR(254) NOT NULL UNIQUE,
    email VARCHAR(254) NOT NULL UNIQUE,
    streetInfo VARCHAR(254) NOT NULL,
    city VARCHAR(254) NOT NULL,
    PRIMARY KEY (bid),
    FOREIGN KEY (bid) REFERENCES MEMBERS (username),
    FOREIGN KEY (city) REFERENCES CITIES (city)
);

CREATE TABLE FARMER_REPUTATIONS(
    avgRating INT NOT NULL,
    farmerRep VARCHAR(254) NOT NULL,
    PRIMARY KEY (avgRating)
);

CREATE TABLE FARMERS (
    fid VARCHAR(254) NOT NULL,
    fName VARCHAR(254) NOT NULL,
	lName VARCHAR(254) NOT NULL,
    phone VARCHAR(254) NOT NULL UNIQUE,
    email VARCHAR(254) NOT NULL UNIQUE,
    avgRating INT NOT NULL,
    streetInfo VARCHAR(254) NOT NULL,
    city VARCHAR(254) NOT NULL,
    PRIMARY KEY (fid),
    FOREIGN KEY (fid) REFERENCES MEMBERS (username),
    FOREIGN KEY (avgRating) REFERENCES FARMER_REPUTATIONS (avgRating),
    FOREIGN KEY (city) REFERENCES CITIES (city)
);

CREATE TABLE IRRIGATION_METHODS (
    category VARCHAR(254) NOT NULL,
    bestIrrigation VARCHAR(254) NOT NULL,
    PRIMARY KEY(category)
);

CREATE TABLE CROPS (
	cropName VARCHAR(254) NOT NULL,
    cropType VARCHAR(254) NOT NULL,
    category VARCHAR(254) NOT NULL,
    unitToSell VARCHAR(254) NOT NULL,
    PRIMARY KEY(cropName),
    FOREIGN KEY (category) REFERENCES IRRIGATION_METHODS (category)
);

CREATE TABLE ADDITIONAL_CHARGES (
	organicTrue BOOL NOT NULL,
    extraCharge INT NOT NULL,
    PRIMARY KEY(organicTrue)
);

CREATE TABLE PRODUCTS (
	pid INT NOT NULL AUTO_INCREMENT,
    fid VARCHAR(254) NOT NULL,
    cropName VARCHAR(254) NOT NULL,
    pricePerUnit INT NOT NULL,
    organicTrue BOOL NOT NULL,
    avgRating INT NOT NULL,
    remaining FLOAT(4) NOT NULL,
    image BLOB,
    PRIMARY KEY(pid),
    FOREIGN KEY(fid) REFERENCES FARMERS(fid),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName),
    FOREIGN KEY(organicTrue) REFERENCES ADDITIONAL_CHARGES(organicTrue),
    FOREIGN KEY(avgRating) REFERENCES FARMER_REPUTATIONS(avgRating)
);

CREATE TABLE PRODUCT_REPUTATIONS (
	avgRating INT NOT NULL,
    productRep VARCHAR(254) NOT NULL,
    PRIMARY KEY(avgRating)
);

CREATE TABLE PRODUCT_REVIEWS (
    reviewid INT NOT NULL AUTO_INCREMENT,
	reviewAuthor VARCHAR(254) NOT NULL,
    pid INT NOT NULL,
    rating INT NOT NULL,
    reviewBody TEXT NOT NULL,
    PRIMARY KEY(reviewid),
    FOREIGN KEY(reviewAuthor) REFERENCES BUYERS(bid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid)
);

CREATE TABLE ORDERS (
	oid INT NOT NULL AUTO_INCREMENT,
    pid INT NOT NULL,
    bid VARCHAR(254) NOT NULL,
    amount FLOAT(4) NOT NULL,
    totalPrice INT,
    orderDate DATETIME NOT NULL,
    PRIMARY KEY(oid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid),
    FOREIGN KEY(bid) REFERENCES BUYERS(bid)
);

CREATE TABLE STORES (
	cartid INT NOT NULL AUTO_INCREMENT,
    pid INT NOT NULL,
    bid VARCHAR(254) NOT NULL,
    amount FLOAT(4) NOT NULL,
    rawTotalPrice INT NOT NULL,
    discountRate INT,
    extraCharge INT NOT NULL,
    PRIMARY KEY(cartid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid),
    FOREIGN KEY(bid) REFERENCES BUYERS(bid)
);

CREATE TABLE DISCOUNT_RATES (
    discountid INT NOT NULL AUTO_INCREMENT,
	rate INT NOT NULL,
    minQuantity INT NOT NULL,
    maxQuantity INT NOT NULL,
    pid INT NOT NULL,
    PRIMARY KEY(discountid),
    FOREIGN KEY(pid) REFERENCES PRODUCTS(pid)
);

CREATE TABLE SUB_PRODUCTS (
	subid INT NOT NULL AUTO_INCREMENT,
    fid VARCHAR(254) NOT NULL,
    cropName VARCHAR(254) NOT NULL,
    quantityPerSub FLOAT(4) NOT NULL,
    price INT NOT NULL,
    period FLOAT(4) NOT NULL,
    PRIMARY KEY(subid),
    FOREIGN KEY(fid) REFERENCES FARMERS(fid),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName)
);

CREATE TABLE SUB_ORDERS (
	subid INT NOT NULL AUTO_INCREMENT,
    bid VARCHAR(254) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE,
    PRIMARY KEY(subid, bid),
    FOREIGN KEY(subid) REFERENCES SUB_PRODUCTS(subid),
    FOREIGN KEY(bid) REFERENCES BUYERS(bid)
);

CREATE TABLE POSTS (
	postid INT NOT NULL AUTO_INCREMENT,
    fid VARCHAR(254) NOT NULL,
    title VARCHAR(254) NOT NULL,
    cropName VARCHAR(254) NOT NULL,
    description VARCHAR(254) NOT NULL,
    uses VARCHAR(254) NOT NULL,
    disease VARCHAR(254) NOT NULL,
    image BLOB,
    postDate DATE NOT NULL,
    PRIMARY KEY(postid),
    FOREIGN KEY(fid) REFERENCES FARMERS(fid),
    FOREIGN KEY(cropName) REFERENCES CROPS(cropName)
);

CREATE TABLE SAVED_POSTS (
	username VARCHAR(254) NOT NULL,
    postid INT NOT NULL,
    PRIMARY KEY(username, postid),
    FOREIGN KEY(username) REFERENCES MEMBERS(username),
    FOREIGN KEY(postid) REFERENCES POSTS(postid)
);

CREATE TABLE POST_COMMENTS (
    commentid INT NOT NULL AUTO_INCREMENT,
	postid INT NOT NULL,
    username VARCHAR(254) NOT NULL,
    commentBody TEXT NOT NULL,
    PRIMARY KEY(commentid),
    FOREIGN KEY(postid) REFERENCES POSTS(postid),
    FOREIGN KEY(username) REFERENCES MEMBERS(username)
);
