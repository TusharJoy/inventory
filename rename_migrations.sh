#!/bin/bash

# Base tables (no dependencies)
mv 0001_01_01_000000_create_users_table.php 2025_04_08_000001_create_users_table.php
mv 0001_01_01_000001_create_cache_table.php 2025_04_08_000002_create_cache_table.php
mv 0001_01_01_000002_create_jobs_table.php 2025_04_08_000003_create_jobs_table.php

# Core entity tables (depend on base tables)
mv 2025_04_08_000001_create_farmers_table.php 2025_04_08_000004_create_farmers_table.php
mv 2025_04_08_000004_create_warehouses_table.php 2025_04_08_000005_create_warehouses_table.php
mv 2025_04_08_171441_create_customers_table.php 2025_04_08_000006_create_customers_table.php
mv 2025_04_08_171441_create_markets_table.php 2025_04_08_000007_create_markets_table.php

# First level dependent tables (depend on core entities)
mv 2025_04_08_000002_create_farmer_contacts_table.php 2025_04_08_000008_create_farmer_contacts_table.php
mv 2025_04_08_171442_create_customer_contacts_table.php 2025_04_08_000009_create_customer_contacts_table.php
mv 2025_04_08_000003_create_harvest_sessions_table.php 2025_04_08_000010_create_harvest_sessions_table.php
mv 2025_04_08_000008_create_batches_table.php 2025_04_08_000011_create_batches_table.php
mv 2025_04_08_171441_create_warehouse_climate_logs_table.php 2025_04_08_000012_create_warehouse_climate_logs_table.php
mv 2025_04_08_171441_create_warehouse_stocks_table.php 2025_04_08_000013_create_warehouse_stocks_table.php

# Second level dependent tables (depend on first level tables)
mv 2025_04_08_000009_create_crops_table.php 2025_04_08_000014_create_crops_table.php
mv 2025_04_08_171442_create_orders_table.php 2025_04_08_000015_create_orders_table.php
mv 2025_04_08_000006_create_purchases_table.php 2025_04_08_000016_create_purchases_table.php
mv 2025_04_08_171442_create_batch_purchases_table.php 2025_04_08_000017_create_batch_purchases_table.php
mv 2025_04_08_000007_create_shipments_table.php 2025_04_08_000018_create_shipments_table.php
mv 2025_04_08_171442_create_batch_shipments_table.php 2025_04_08_000019_create_batch_shipments_table.php
mv 2025_04_08_171442_create_transport_vehicles_table.php 2025_04_08_000020_create_transport_vehicles_table.php
mv 2025_04_08_171442_create_shipment_transports_table.php 2025_04_08_000021_create_shipment_transports_table.php
mv 2025_04_08_171442_create_nutritional_analyses_table.php 2025_04_08_000022_create_nutritional_analyses_table.php

# User modifications (depend on users table)
mv 2025_04_08_172224_add_user_type_to_users_table.php 2025_04_08_000023_add_user_type_to_users_table.php 