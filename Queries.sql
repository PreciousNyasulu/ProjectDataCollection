
-- project data tables 
CREATE TABLE 
    `l5dcproject`.`surveyaccounts` 
        ( `ID` INT NOT NULL AUTO_INCREMENT , `Username` VARCHAR(30) NOT NULL ,
         `Email` VARCHAR(30) NOT NULL , `Password` VARCHAR(1000) NOT NULL , `DOB` DATE NOT NULL ,
          `Sex` VARCHAR(6) NOT NULL , `Location` VARCHAR(50) NOT NULL 
        , `Occupation` VARCHAR(30) NOT NULL , PRIMARY KEY (`ID`) ENGINE = InnoDB;