CREATE VIEW users_view AS
SELECT u.id, u.first_name, u.last_name, u.phone, u.email, u.password, u.image, r.role_name as role FROM {$tx}users u , {$tx}roles r WHERE r.id = u.role_id;