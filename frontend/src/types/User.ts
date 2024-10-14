export type Permission = {
  name: string;
};

export type User = {
  name: string;
  email: string;
  username: string;
  all_permissions: Permission[];
}
