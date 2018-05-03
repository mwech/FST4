
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- allergy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `allergy`;

CREATE TABLE `allergy`
(
    `allergy_id` INTEGER NOT NULL,
    `description` VARCHAR(45),
    PRIMARY KEY (`allergy_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- article
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article`
(
    `article_id` INTEGER NOT NULL,
    `description` VARCHAR(45),
    `price` DOUBLE,
    `creation` bit(1),
    `visible` bit(1),
    `shape_id` INTEGER NOT NULL,
    `cake_type_id` INTEGER NOT NULL,
    PRIMARY KEY (`article_id`),
    INDEX `fk_article_shape1_idx` (`shape_id`),
    INDEX `fk_article_cake_type1_idx` (`cake_type_id`),
    CONSTRAINT `fk_article_cake_type1`
        FOREIGN KEY (`cake_type_id`)
        REFERENCES `cake_type` (`cake_type_id`),
    CONSTRAINT `fk_article_shape1`
        FOREIGN KEY (`shape_id`)
        REFERENCES `shape` (`shape_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- article_has_ingredient
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `article_has_ingredient`;

CREATE TABLE `article_has_ingredient`
(
    `article_id` INTEGER NOT NULL,
    `ingredient_id` INTEGER NOT NULL,
    `amount` DOUBLE,
    PRIMARY KEY (`article_id`,`ingredient_id`),
    INDEX `fk_article_has_ingredient_ingredient1_idx` (`ingredient_id`),
    CONSTRAINT `fk_article_has_ingredient_article1`
        FOREIGN KEY (`article_id`)
        REFERENCES `article` (`article_id`),
    CONSTRAINT `fk_article_has_ingredient_ingredient1`
        FOREIGN KEY (`ingredient_id`)
        REFERENCES `ingredient` (`ingredient_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- business_customer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `business_customer`;

CREATE TABLE `business_customer`
(
    `VAT_Nr` INTEGER NOT NULL,
    `description` VARCHAR(45),
    `person_id` INTEGER NOT NULL,
    PRIMARY KEY (`VAT_Nr`),
    INDEX `fk_Business_customer_person1_idx` (`person_id`),
    CONSTRAINT `fk_Business_customer_person1`
        FOREIGN KEY (`person_id`)
        REFERENCES `person` (`person_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- cake_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cake_type`;

CREATE TABLE `cake_type`
(
    `cake_type_id` INTEGER NOT NULL,
    `description` VARCHAR(45),
    PRIMARY KEY (`cake_type_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- city
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city`
(
    `zip_code` INTEGER NOT NULL,
    `name` VARCHAR(45),
    PRIMARY KEY (`zip_code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ingredient
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ingredient`;

CREATE TABLE `ingredient`
(
    `ingredient_id` INTEGER NOT NULL,
    `description` VARCHAR(45),
    `price` DOUBLE,
    PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ingredient_has_allergy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ingredient_has_allergy`;

CREATE TABLE `ingredient_has_allergy`
(
    `ingredient_id` INTEGER NOT NULL,
    `allergy_id` INTEGER NOT NULL,
    PRIMARY KEY (`ingredient_id`,`allergy_id`),
    INDEX `fk_ingredient_has_allergy_allergy1_idx` (`allergy_id`),
    CONSTRAINT `fk_ingredient_has_allergy_allergy1`
        FOREIGN KEY (`allergy_id`)
        REFERENCES `allergy` (`allergy_id`),
    CONSTRAINT `fk_ingredient_has_allergy_ingredient`
        FOREIGN KEY (`ingredient_id`)
        REFERENCES `ingredient` (`ingredient_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- order
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order`
(
    `order_id` INTEGER NOT NULL,
    `date` DATE,
    `total_amount` DOUBLE,
    `person_id` INTEGER NOT NULL,
    `voucher_id` INTEGER NOT NULL,
    PRIMARY KEY (`order_id`),
    INDEX `fk_order_person1_idx` (`person_id`),
    INDEX `fk_order_voucher1_idx` (`voucher_id`),
    CONSTRAINT `fk_order_person1`
        FOREIGN KEY (`person_id`)
        REFERENCES `person` (`person_id`),
    CONSTRAINT `fk_order_voucher1`
        FOREIGN KEY (`voucher_id`)
        REFERENCES `voucher` (`voucher_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- order_has_articles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order_has_articles`;

CREATE TABLE `order_has_articles`
(
    `order_id` INTEGER NOT NULL,
    `article_id` INTEGER NOT NULL,
    `amount` INTEGER,
    `price` DOUBLE,
    PRIMARY KEY (`order_id`,`article_id`),
    INDEX `fk_order_has_articles_article1_idx` (`article_id`),
    CONSTRAINT `fk_order_has_articles_article1`
        FOREIGN KEY (`article_id`)
        REFERENCES `article` (`article_id`),
    CONSTRAINT `fk_order_has_articles_order1`
        FOREIGN KEY (`order_id`)
        REFERENCES `order` (`order_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- package
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `package`;

CREATE TABLE `package`
(
    `package_id` INTEGER NOT NULL,
    `description` VARCHAR(45),
    `price` DOUBLE,
    PRIMARY KEY (`package_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- package_has_articles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `package_has_articles`;

CREATE TABLE `package_has_articles`
(
    `package_id` INTEGER NOT NULL,
    `article_id` INTEGER NOT NULL,
    PRIMARY KEY (`package_id`,`article_id`),
    INDEX `fk_package_has_articles_article1_idx` (`article_id`),
    CONSTRAINT `fk_package_has_articles_article1`
        FOREIGN KEY (`article_id`)
        REFERENCES `article` (`article_id`),
    CONSTRAINT `fk_package_has_articles_package1`
        FOREIGN KEY (`package_id`)
        REFERENCES `package` (`package_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- person
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person`
(
    `person_id` INTEGER NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(45),
    `lastname` VARCHAR(45),
    `email` VARCHAR(45),
    `password` VARCHAR(45),
    `birthdate` VARCHAR(45),
    `street` VARCHAR(45),
    `country` VARCHAR(45),
    `zip_code` INTEGER NOT NULL,
    `type_id` INTEGER NOT NULL,
    PRIMARY KEY (`person_id`),
    INDEX `fk_person_city1_idx` (`zip_code`),
    INDEX `fk_person_type1_idx` (`type_id`),
    CONSTRAINT `fk_person_city1`
        FOREIGN KEY (`zip_code`)
        REFERENCES `city` (`zip_code`),
    CONSTRAINT `fk_person_type1`
        FOREIGN KEY (`type_id`)
        REFERENCES `type` (`type_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- rating
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `rating`;

CREATE TABLE `rating`
(
    `article_id` INTEGER NOT NULL,
    `person_id` INTEGER NOT NULL,
    `stars` INTEGER,
    `comment` VARCHAR(200),
    `visible` bit(1),
    PRIMARY KEY (`article_id`,`person_id`),
    INDEX `fk_rating_person1_idx` (`person_id`),
    CONSTRAINT `fk_rating_article1`
        FOREIGN KEY (`article_id`)
        REFERENCES `article` (`article_id`),
    CONSTRAINT `fk_rating_person1`
        FOREIGN KEY (`person_id`)
        REFERENCES `person` (`person_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shape
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shape`;

CREATE TABLE `shape`
(
    `shape_id` INTEGER NOT NULL,
    `description` VARCHAR(45),
    PRIMARY KEY (`shape_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- special_offer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `special_offer`;

CREATE TABLE `special_offer`
(
    `special_offer_id` INTEGER NOT NULL,
    `code` VARCHAR(10),
    `start_date` DATE,
    `end_date` DATE,
    `percentage` DOUBLE,
    PRIMARY KEY (`special_offer_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type`
(
    `type_id` INTEGER NOT NULL,
    `description` VARCHAR(45),
    PRIMARY KEY (`type_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- voucher
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `voucher`;

CREATE TABLE `voucher`
(
    `voucher_id` INTEGER NOT NULL,
    `amount` DOUBLE,
    `code` VARCHAR(10),
    `used` bit(1),
    `date` DATE,
    PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
