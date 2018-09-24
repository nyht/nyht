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

ALTER TABLE sales.customer DROP CONSTRAINT DF_Customer_rowguid;
DROP INDEX AK_Customer_rowguid ON sales.customer;
ALTER TABLE sales.customer DROP COLUMN rowguid;

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

ALTER TABLE person.addresstype DROP CONSTRAINT DF_AddressType_rowguid;
DROP INDEX AK_AddressType_rowguid ON person.addresstype;
ALTER TABLE person.addresstype DROP COLUMN rowguid;

ALTER TABLE person.businessentitycontact DROP CONSTRAINT DF_BusinessEntityContact_rowguid;
DROP INDEX AK_BusinessEntityContact_rowguid ON person.businessentitycontact;
ALTER TABLE person.businessentitycontact DROP COLUMN rowguid;

ALTER TABLE person.personphone ALTER COLUMN phonenumber nvarchar(25) NOT NULL;

ALTER TABLE person.phonenumbertype ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE person.stateprovince ALTER COLUMN isonlystateprovinceflag bit NOT NULL;
ALTER TABLE person.stateprovince ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE person.stateprovince DROP CONSTRAINT DF_StateProvince_rowguid;
DROP INDEX AK_StateProvince_rowguid ON person.stateprovince;
ALTER TABLE person.stateprovince DROP COLUMN rowguid;

ALTER TABLE production.culture ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE production.location ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE production.product ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE production.product ALTER COLUMN makeflag bit NOT NULL;
ALTER TABLE production.product DROP CONSTRAINT DF_Product_rowguid;
DROP INDEX AK_Product_rowguid ON production.product;
ALTER TABLE production.product DROP COLUMN rowguid;

ALTER TABLE production.productcategory ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE production.productcategory DROP CONSTRAINT DF_ProductCategory_rowguid;
DROP INDEX AK_ProductCategory_rowguid ON production.productcategory;
ALTER TABLE production.productcategory DROP COLUMN rowguid;

ALTER TABLE production.productdescription DROP CONSTRAINT DF_ProductDescription_rowguid;
DROP INDEX AK_ProductDescription_rowguid ON production.productdescription;
ALTER TABLE production.productdescription DROP COLUMN rowguid;

ALTER TABLE production.productdescription DROP CONSTRAINT DF_ProductDescription_rowguid;
DROP INDEX AK_ProductDescription_rowguid ON production.productdescription;
ALTER TABLE production.productdescription DROP COLUMN rowguid;

ALTER TABLE production.productinventory DROP CONSTRAINT DF_ProductInventory_rowguid;
ALTER TABLE production.productinventory DROP COLUMN rowguid;

ALTER TABLE production.productmodel ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE production.productmodel DROP CONSTRAINT DF_ProductModel_rowguid;
DROP INDEX AK_ProductModel_rowguid ON production.productmodel;
ALTER TABLE production.productmodel DROP COLUMN rowguid;

ALTER TABLE production.productphoto DROP COLUMN thumbnailphoto;
ALTER TABLE production.productphoto DROP COLUMN largephotofilename;
ALTER TABLE production.productphoto DROP COLUMN largephoto;

ALTER TABLE production.productproductphoto ALTER COLUMN [primary] bit NOT NULL;

ALTER TABLE production.productreview ALTER COLUMN reviewername nvarchar(50) NOT NULL;

ALTER TABLE production.productsubcategory ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE production.productsubcategory DROP CONSTRAINT DF_ProductSubcategory_rowguid;
DROP INDEX AK_ProductSubcategory_rowguid ON production.productsubcategory;
ALTER TABLE production.productsubcategory DROP COLUMN rowguid;

ALTER TABLE production.scrapreason ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE production.unitmeasure ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE production.workorder DROP COLUMN stockedqty;

ALTER TABLE production.purchaseorderheader DROP COLUMN totaldue;

DROP TABLE person.password;

ALTER TABLE sales.currency ALTER COLUMN name nvarchar(50) NOT NULL;

drop index AK_Customer_AccountNumber on sales.customer;
alter table sales.customer drop column accountnumber;

drop index AK_Customer_AccountNumber on sales.customer;
alter table sales.customer drop column accountnumber;

alter table sales.salesorderdetail drop column linetotal;

ALTER TABLE sales.salesorderdetail DROP CONSTRAINT DF_SalesOrderDetail_rowguid;
DROP INDEX AK_SalesOrderDetail_rowguid ON sales.salesorderdetail;
ALTER TABLE sales.salesorderdetail DROP COLUMN rowguid;

ALTER TABLE sales.salesorderheader ALTER COLUMN onlineorderflag bit NOT NULL;
drop index AK_SalesOrderHeader_SalesOrderNumber on sales.salesorderheader;
alter table sales.salesorderheader drop column salesordernumber;
alter table sales.salesorderheader drop column totaldue;
ALTER TABLE sales.salesorderheader DROP CONSTRAINT DF_SalesOrderHeader_rowguid;
DROP INDEX AK_SalesOrderHeader_rowguid ON sales.salesorderheader;
ALTER TABLE sales.salesorderheader DROP COLUMN rowguid;

ALTER TABLE sales.salesperson DROP CONSTRAINT DF_SalesPerson_rowguid;
DROP INDEX AK_SalesPerson_rowguid ON sales.salesperson;
ALTER TABLE sales.salesperson DROP COLUMN rowguid;

ALTER TABLE sales.salespersonquotahistory DROP CONSTRAINT DF_SalesPersonQuotaHistory_rowguid;
DROP INDEX AK_SalesPersonQuotaHistory_rowguid ON sales.salespersonquotahistory;
ALTER TABLE sales.salespersonquotahistory DROP COLUMN rowguid;

ALTER TABLE sales.salesreason ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE sales.salesreason ALTER COLUMN reasontype nvarchar(50) NOT NULL;

ALTER TABLE sales.salestaxrate ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE sales.salestaxrate DROP CONSTRAINT DF_SalesTaxRate_rowguid;
DROP INDEX AK_SalesTaxRate_rowguid ON sales.salestaxrate;
ALTER TABLE sales.salestaxrate DROP COLUMN rowguid;

ALTER TABLE sales.salesterritory ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE sales.salesterritory DROP CONSTRAINT DF_SalesTerritory_rowguid;
DROP INDEX AK_SalesTerritory_rowguid ON sales.salesterritory;
ALTER TABLE sales.salesterritory DROP COLUMN rowguid;

ALTER TABLE sales.salesterritoryhistory DROP CONSTRAINT DF_SalesTerritoryHistory_rowguid;
DROP INDEX AK_SalesTerritoryHistory_rowguid ON sales.salesterritoryhistory;
ALTER TABLE sales.salesterritoryhistory DROP COLUMN rowguid;

ALTER TABLE sales.specialoffer DROP CONSTRAINT DF_SpecialOffer_rowguid;
DROP INDEX AK_SpecialOffer_rowguid ON sales.specialoffer;
ALTER TABLE sales.specialoffer DROP COLUMN rowguid;

ALTER TABLE sales.specialofferproduct DROP CONSTRAINT DF_SpecialOfferProduct_rowguid;
DROP INDEX AK_SpecialOfferProduct_rowguid ON sales.specialofferproduct;
ALTER TABLE sales.specialofferproduct DROP COLUMN rowguid;

ALTER TABLE sales.store ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE sales.store DROP CONSTRAINT DF_Store_rowguid;
DROP INDEX AK_Store_rowguid ON sales.store;
ALTER TABLE sales.store DROP COLUMN rowguid;

ALTER TABLE person.contacttype ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE purchasing.shipmethod DROP CONSTRAINT DF_ShipMethod_rowguid;
DROP INDEX AK_ShipMethod_rowguid ON purchasing.shipmethod;
ALTER TABLE purchasing.shipmethod DROP COLUMN rowguid;
ALTER TABLE purchasing.shipmethod ALTER COLUMN name nvarchar(50) NOT NULL;

ALTER TABLE purchasing.vendor ALTER COLUMN name nvarchar(50) NOT NULL;
ALTER TABLE purchasing.vendor ALTER COLUMN preferredvendorstatus bit NOT NULL;
ALTER TABLE purchasing.vendor ALTER COLUMN activeflag bit NOT NULL;

--SELECT
--    'ALTER TABLE '+TABLE_SCHEMA+'.'+TABLE_NAME+' DROP CONSTRAINT DF_'+TABLE_NAME+'_ModifiedDate;'+
--	'ALTER TABLE '+TABLE_SCHEMA+'.'+TABLE_NAME+' DROP COLUMN ModifiedDate;'
--FROM
--	INFORMATION_SCHEMA.columns
--where
--	column_name = 'ModifiedDate'

ALTER TABLE Production.ScrapReason DROP CONSTRAINT DF_ScrapReason_ModifiedDate;ALTER TABLE Production.ScrapReason DROP COLUMN ModifiedDate;
ALTER TABLE HumanResources.Shift DROP CONSTRAINT DF_Shift_ModifiedDate;ALTER TABLE HumanResources.Shift DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductCategory DROP CONSTRAINT DF_ProductCategory_ModifiedDate;ALTER TABLE Production.ProductCategory DROP COLUMN ModifiedDate;
ALTER TABLE Purchasing.ShipMethod DROP CONSTRAINT DF_ShipMethod_ModifiedDate;ALTER TABLE Purchasing.ShipMethod DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductCostHistory DROP CONSTRAINT DF_ProductCostHistory_ModifiedDate;ALTER TABLE Production.ProductCostHistory DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductDescription DROP CONSTRAINT DF_ProductDescription_ModifiedDate;ALTER TABLE Production.ProductDescription DROP COLUMN ModifiedDate;
ALTER TABLE Sales.ShoppingCartItem DROP CONSTRAINT DF_ShoppingCartItem_ModifiedDate;ALTER TABLE Sales.ShoppingCartItem DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductInventory DROP CONSTRAINT DF_ProductInventory_ModifiedDate;ALTER TABLE Production.ProductInventory DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SpecialOffer DROP CONSTRAINT DF_SpecialOffer_ModifiedDate;ALTER TABLE Sales.SpecialOffer DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductListPriceHistory DROP CONSTRAINT DF_ProductListPriceHistory_ModifiedDate;ALTER TABLE Production.ProductListPriceHistory DROP COLUMN ModifiedDate;
ALTER TABLE Person.Address DROP CONSTRAINT DF_Address_ModifiedDate;ALTER TABLE Person.Address DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SpecialOfferProduct DROP CONSTRAINT DF_SpecialOfferProduct_ModifiedDate;ALTER TABLE Sales.SpecialOfferProduct DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductModel DROP CONSTRAINT DF_ProductModel_ModifiedDate;ALTER TABLE Production.ProductModel DROP COLUMN ModifiedDate;
ALTER TABLE Person.StateProvince DROP CONSTRAINT DF_StateProvince_ModifiedDate;ALTER TABLE Person.StateProvince DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductModelIllustration DROP CONSTRAINT DF_ProductModelIllustration_ModifiedDate;ALTER TABLE Production.ProductModelIllustration DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductModelProductDescriptionCulture DROP CONSTRAINT DF_ProductModelProductDescriptionCulture_ModifiedDate;ALTER TABLE Production.ProductModelProductDescriptionCulture DROP COLUMN ModifiedDate;
ALTER TABLE Production.BillOfMaterials DROP CONSTRAINT DF_BillOfMaterials_ModifiedDate;ALTER TABLE Production.BillOfMaterials DROP COLUMN ModifiedDate;
ALTER TABLE Sales.Store DROP CONSTRAINT DF_Store_ModifiedDate;ALTER TABLE Sales.Store DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductPhoto DROP CONSTRAINT DF_ProductPhoto_ModifiedDate;ALTER TABLE Production.ProductPhoto DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductProductPhoto DROP CONSTRAINT DF_ProductProductPhoto_ModifiedDate;ALTER TABLE Production.ProductProductPhoto DROP COLUMN ModifiedDate;
ALTER TABLE Production.TransactionHistory DROP CONSTRAINT DF_TransactionHistory_ModifiedDate;ALTER TABLE Production.TransactionHistory DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductReview DROP CONSTRAINT DF_ProductReview_ModifiedDate;ALTER TABLE Production.ProductReview DROP COLUMN ModifiedDate;
ALTER TABLE Person.BusinessEntity DROP CONSTRAINT DF_BusinessEntity_ModifiedDate;ALTER TABLE Person.BusinessEntity DROP COLUMN ModifiedDate;
ALTER TABLE Production.TransactionHistoryArchive DROP CONSTRAINT DF_TransactionHistoryArchive_ModifiedDate;ALTER TABLE Production.TransactionHistoryArchive DROP COLUMN ModifiedDate;
ALTER TABLE Production.ProductSubcategory DROP CONSTRAINT DF_ProductSubcategory_ModifiedDate;ALTER TABLE Production.ProductSubcategory DROP COLUMN ModifiedDate;
ALTER TABLE Person.BusinessEntityAddress DROP CONSTRAINT DF_BusinessEntityAddress_ModifiedDate;ALTER TABLE Person.BusinessEntityAddress DROP COLUMN ModifiedDate;
ALTER TABLE Purchasing.ProductVendor DROP CONSTRAINT DF_ProductVendor_ModifiedDate;ALTER TABLE Purchasing.ProductVendor DROP COLUMN ModifiedDate;
ALTER TABLE Person.BusinessEntityContact DROP CONSTRAINT DF_BusinessEntityContact_ModifiedDate;ALTER TABLE Person.BusinessEntityContact DROP COLUMN ModifiedDate;
ALTER TABLE Production.UnitMeasure DROP CONSTRAINT DF_UnitMeasure_ModifiedDate;ALTER TABLE Production.UnitMeasure DROP COLUMN ModifiedDate;
ALTER TABLE Purchasing.Vendor DROP CONSTRAINT DF_Vendor_ModifiedDate;ALTER TABLE Purchasing.Vendor DROP COLUMN ModifiedDate;
ALTER TABLE Person.ContactType DROP CONSTRAINT DF_ContactType_ModifiedDate;ALTER TABLE Person.ContactType DROP COLUMN ModifiedDate;
ALTER TABLE Sales.CountryRegionCurrency DROP CONSTRAINT DF_CountryRegionCurrency_ModifiedDate;ALTER TABLE Sales.CountryRegionCurrency DROP COLUMN ModifiedDate;
ALTER TABLE Person.CountryRegion DROP CONSTRAINT DF_CountryRegion_ModifiedDate;ALTER TABLE Person.CountryRegion DROP COLUMN ModifiedDate;
ALTER TABLE Production.WorkOrder DROP CONSTRAINT DF_WorkOrder_ModifiedDate;ALTER TABLE Production.WorkOrder DROP COLUMN ModifiedDate;
ALTER TABLE Purchasing.PurchaseOrderDetail DROP CONSTRAINT DF_PurchaseOrderDetail_ModifiedDate;ALTER TABLE Purchasing.PurchaseOrderDetail DROP COLUMN ModifiedDate;
ALTER TABLE Sales.CreditCard DROP CONSTRAINT DF_CreditCard_ModifiedDate;ALTER TABLE Sales.CreditCard DROP COLUMN ModifiedDate;
ALTER TABLE Production.Culture DROP CONSTRAINT DF_Culture_ModifiedDate;ALTER TABLE Production.Culture DROP COLUMN ModifiedDate;
ALTER TABLE Production.WorkOrderRouting DROP CONSTRAINT DF_WorkOrderRouting_ModifiedDate;ALTER TABLE Production.WorkOrderRouting DROP COLUMN ModifiedDate;
ALTER TABLE Sales.Currency DROP CONSTRAINT DF_Currency_ModifiedDate;ALTER TABLE Sales.Currency DROP COLUMN ModifiedDate;
ALTER TABLE Purchasing.PurchaseOrderHeader DROP CONSTRAINT DF_PurchaseOrderHeader_ModifiedDate;ALTER TABLE Purchasing.PurchaseOrderHeader DROP COLUMN ModifiedDate;
ALTER TABLE Sales.CurrencyRate DROP CONSTRAINT DF_CurrencyRate_ModifiedDate;ALTER TABLE Sales.CurrencyRate DROP COLUMN ModifiedDate;
ALTER TABLE Sales.Customer DROP CONSTRAINT DF_Customer_ModifiedDate;ALTER TABLE Sales.Customer DROP COLUMN ModifiedDate;
ALTER TABLE HumanResources.Department DROP CONSTRAINT DF_Department_ModifiedDate;ALTER TABLE HumanResources.Department DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesOrderDetail DROP CONSTRAINT DF_SalesOrderDetail_ModifiedDate;ALTER TABLE Sales.SalesOrderDetail DROP COLUMN ModifiedDate;
ALTER TABLE HumanResources.JobCandidate DROP CONSTRAINT DF_JobCandidate_ModifiedDate;ALTER TABLE HumanResources.JobCandidate DROP COLUMN ModifiedDate;
ALTER TABLE Person.EmailAddress DROP CONSTRAINT DF_EmailAddress_ModifiedDate;ALTER TABLE Person.EmailAddress DROP COLUMN ModifiedDate;
ALTER TABLE HumanResources.Employee DROP CONSTRAINT DF_Employee_ModifiedDate;ALTER TABLE HumanResources.Employee DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesOrderHeader DROP CONSTRAINT DF_SalesOrderHeader_ModifiedDate;ALTER TABLE Sales.SalesOrderHeader DROP COLUMN ModifiedDate;
ALTER TABLE HumanResources.EmployeeDepartmentHistory DROP CONSTRAINT DF_EmployeeDepartmentHistory_ModifiedDate;ALTER TABLE HumanResources.EmployeeDepartmentHistory DROP COLUMN ModifiedDate;
ALTER TABLE HumanResources.EmployeePayHistory DROP CONSTRAINT DF_EmployeePayHistory_ModifiedDate;ALTER TABLE HumanResources.EmployeePayHistory DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesOrderHeaderSalesReason DROP CONSTRAINT DF_SalesOrderHeaderSalesReason_ModifiedDate;ALTER TABLE Sales.SalesOrderHeaderSalesReason DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesPerson DROP CONSTRAINT DF_SalesPerson_ModifiedDate;ALTER TABLE Sales.SalesPerson DROP COLUMN ModifiedDate;
ALTER TABLE Production.Illustration DROP CONSTRAINT DF_Illustration_ModifiedDate;ALTER TABLE Production.Illustration DROP COLUMN ModifiedDate;
ALTER TABLE Person.AddressType DROP CONSTRAINT DF_AddressType_ModifiedDate;ALTER TABLE Person.AddressType DROP COLUMN ModifiedDate;
ALTER TABLE Production.Location DROP CONSTRAINT DF_Location_ModifiedDate;ALTER TABLE Production.Location DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesPersonQuotaHistory DROP CONSTRAINT DF_SalesPersonQuotaHistory_ModifiedDate;ALTER TABLE Sales.SalesPersonQuotaHistory DROP COLUMN ModifiedDate;
ALTER TABLE Person.Person DROP CONSTRAINT DF_Person_ModifiedDate;ALTER TABLE Person.Person DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesReason DROP CONSTRAINT DF_SalesReason_ModifiedDate;ALTER TABLE Sales.SalesReason DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesTaxRate DROP CONSTRAINT DF_SalesTaxRate_ModifiedDate;ALTER TABLE Sales.SalesTaxRate DROP COLUMN ModifiedDate;
ALTER TABLE Sales.PersonCreditCard DROP CONSTRAINT DF_PersonCreditCard_ModifiedDate;ALTER TABLE Sales.PersonCreditCard DROP COLUMN ModifiedDate;
ALTER TABLE Person.PersonPhone DROP CONSTRAINT DF_PersonPhone_ModifiedDate;ALTER TABLE Person.PersonPhone DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesTerritory DROP CONSTRAINT DF_SalesTerritory_ModifiedDate;ALTER TABLE Sales.SalesTerritory DROP COLUMN ModifiedDate;
ALTER TABLE Person.PhoneNumberType DROP CONSTRAINT DF_PhoneNumberType_ModifiedDate;ALTER TABLE Person.PhoneNumberType DROP COLUMN ModifiedDate;
ALTER TABLE Production.Product DROP CONSTRAINT DF_Product_ModifiedDate;ALTER TABLE Production.Product DROP COLUMN ModifiedDate;
ALTER TABLE Sales.SalesTerritoryHistory DROP CONSTRAINT DF_SalesTerritoryHistory_ModifiedDate;ALTER TABLE Sales.SalesTerritoryHistory DROP COLUMN ModifiedDate;