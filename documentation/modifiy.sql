DROP VIEW humanresources.vEmployee;
DROP VIEW humanresources.vEmployeeDepartment;
DROP VIEW humanresources.vEmployeeDepartmentHistory;
DROP VIEW humanresources.vJobCandidate;
DROP VIEW humanresources.vJobCandidateEducation;
DROP VIEW humanresources.vJobCandidateEmployment;

DROP VIEW person.vAdditionalContactInfo;
DROP VIEW person.vStateProvinceCountryRegion;

DROP VIEW production.vProductAndDescription;
DROP VIEW production.vProductModelCatalogDescription;
DROP VIEW production.vProductModelInstructions;

DROP VIEW Purchasing.vVendorWithAddresses;
DROP VIEW Purchasing.vVendorWithContacts;

DROP VIEW Sales.vIndividualCustomer;
DROP VIEW Sales.vPersonDemographics;
DROP VIEW Sales.vSalesPerson;
DROP VIEW Sales.vSalesPersonSalesByFiscalYears;
DROP VIEW Sales.vStoreWithAddresses;
DROP VIEW Sales.vStoreWithContacts;
DROP VIEW Sales.vStoreWithDemographics;

ALTER TABLE humanresources.department ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE humanresources.employee ALTER COLUMN SalariedFlag bit NOT NULL;
ALTER TABLE humanresources.employee ALTER COLUMN CurrentFlag bit NOT NULL;
ALTER TABLE humanresources.employee DROP CONSTRAINT DF_Employee_rowguid;
DROP INDEX AK_Employee_rowguid ON humanresources.employee;
ALTER TABLE humanresources.employee DROP COLUMN rowguid;

ALTER TABLE humanresources.shift ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE person.address DROP CONSTRAINT DF_Address_rowguid;
DROP INDEX AK_Address_rowguid ON person.address;
ALTER TABLE person.address DROP COLUMN rowguid;

ALTER TABLE person.businessentity DROP CONSTRAINT DF_BusinessEntity_rowguid;
DROP INDEX AK_BusinessEntity_rowguid ON person.businessentity;
ALTER TABLE person.businessentity DROP COLUMN rowguid;

ALTER TABLE person.businessentityaddress DROP CONSTRAINT DF_BusinessEntityAddress_rowguid;
DROP INDEX AK_BusinessEntityAddress_rowguid ON person.businessentityaddress;
ALTER TABLE person.businessentityaddress DROP COLUMN rowguid;

ALTER TABLE person.countryregion ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE person.emailaddress DROP CONSTRAINT DF_EmailAddress_rowguid;
ALTER TABLE person.emailaddress DROP COLUMN rowguid;

ALTER TABLE person.password DROP CONSTRAINT DF_Password_rowguid;
ALTER TABLE person.password DROP COLUMN rowguid;

DROP INDEX IX_Person_LastName_FirstName_MiddleName ON person.person;
ALTER TABLE person.person ALTER COLUMN namestyle bit NOT NULL;
ALTER TABLE person.person ALTER COLUMN firstname nvarchar(50) NOT NULL;
ALTER TABLE person.person ALTER COLUMN middlename nvarchar(50) NULL;
ALTER TABLE person.person ALTER COLUMN lastname nvarchar(50) NOT NULL;
ALTER TABLE person.person DROP CONSTRAINT DF_Person_rowguid;
DROP INDEX AK_Person_rowguid ON person.person;
ALTER TABLE person.person DROP COLUMN rowguid;

ALTER TABLE person.personphone ALTER COLUMN phonenumber nvarchar(25) NOT NULL;

ALTER TABLE person.phonenumbertype ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE person.stateprovince ALTER COLUMN isonlystateprovinceflag bit NOT NULL;
ALTER TABLE person.stateprovince ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE person.stateprovince DROP CONSTRAINT DF_StateProvince_rowguid;
DROP INDEX AK_StateProvince_rowguid ON person.stateprovince;
ALTER TABLE person.stateprovince DROP COLUMN rowguid;