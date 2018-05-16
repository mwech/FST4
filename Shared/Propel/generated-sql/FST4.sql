
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- article
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article`
(
    `article_id` VARCHAR(36) NOT NULL,
    `description` VARCHAR(45),
    `price` DOUBLE,
    `creation` binary(1),
    `visible` binary(1),
    `shape_id` VARCHAR(36) NOT NULL,
    `article_type_id` VARCHAR(36) NOT NULL,
    PRIMARY KEY (`article_id`),
    INDEX `fk_article_shape1_idx` (`shape_id`),
    INDEX `fk_article_article_type1_idx` (`article_type_id`),
    CONSTRAINT `fk_article_article_type1`
        FOREIGN KEY (`article_type_id`)
        REFERENCES `article_type` (`article_type_id`),
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
    `article_id` VARCHAR(36) NOT NULL,
    `ingredient_id` VARCHAR(36) NOT NULL,
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
-- article_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `article_type`;

CREATE TABLE `article_type`
(
    `article_type_id` VARCHAR(36) NOT NULL,
    `description` VARCHAR(45),
    PRIMARY KEY (`article_type_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- business customer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `business customer`;

CREATE TABLE `business customer`
(
    `VAT_Nr` VARCHAR(36) NOT NULL,
    `description` VARCHAR(45),
    `person_id` VARCHAR(36) NOT NULL,
    PRIMARY KEY (`VAT_Nr`),
    INDEX `fk_Business customer_person1_idx` (`person_id`),
    CONSTRAINT `fk_Business customer_person1`
        FOREIGN KEY (`person_id`)
        REFERENCES `person` (`person_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category`
(
    `category_id` VARCHAR(36) NOT NULL,
    `description` VARCHAR(45),
    PRIMARY KEY (`category_id`)
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
    `ingredient_id` VARCHAR(36) NOT NULL,
    `description` VARCHAR(45),
    `price` DOUBLE,
    PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ingredient_has_category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ingredient_has_category`;

CREATE TABLE `ingredient_has_category`
(
    `ingredient_id` VARCHAR(36) NOT NULL,
    `category_id` VARCHAR(36) NOT NULL,
    PRIMARY KEY (`ingredient_id`,`category_id`),
    INDEX `fk_ingredient_has_allergy_allergy1_idx` (`category_id`),
    CONSTRAINT `fk_ingredient_has_allergy_allergy1`
        FOREIGN KEY (`category_id`)
        REFERENCES `category` (`category_id`),
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
    `order_id` VARCHAR(36) NOT NULL,
    `date` DATE,
    `total_amount` DOUBLE,
    `person_id` VARCHAR(36) NOT NULL,
    `voucher_id` VARCHAR(36) NOT NULL,
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
    `order_id` VARCHAR(36) NOT NULL,
    `article_id` VARCHAR(36) NOT NULL,
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
    `package_id` VARCHAR(36) NOT NULL,
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
    `package_id` VARCHAR(36) NOT NULL,
    `article_id` VARCHAR(36) NOT NULL,
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
    `person_id` VARCHAR(36) NOT NULL,
    `firstname` VARCHAR(45),
    `lastname` VARCHAR(45),
    `e-mail` VARCHAR(45),
    `password` VARCHAR(45),
    `birthdate` VARCHAR(45),
    `street` VARCHAR(45),
    `country` VARCHAR(45),
    `zip_code` INTEGER NOT NULL,
    `type_id` VARCHAR(36) NOT NULL,
    PRIMARY KEY (`person_id`),
    INDEX `fk_person_city1_idx` (`zip_code`),
    INDEX `fk_person_type1_idx` (`type_id`),
    INDEX `person_id` (`person_id`),
    INDEX `person_id_2` (`person_id`),
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
    `article_id` VARCHAR(36) NOT NULL,
    `person_id` VARCHAR(36) NOT NULL,
    `stars` INTEGER,
    `comment` VARCHAR(200),
    `visible` TINYINT(1),
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
    `shape_id` VARCHAR(36) NOT NULL,
    `description` VARCHAR(45),
    PRIMARY KEY (`shape_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- special_offer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `special_offer`;

CREATE TABLE `special_offer`
(
    `special_offer_id` VARCHAR(36) NOT NULL,
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
    `type_id` VARCHAR(36) NOT NULL,
    `description` VARCHAR(45),
    PRIMARY KEY (`type_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- voucher
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `voucher`;

CREATE TABLE `voucher`
(
    `voucher_id` VARCHAR(36) NOT NULL,
    `amount` DOUBLE,
    `code` VARCHAR(10),
    `used` TINYINT(1),
    `date` DATE,
    PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
