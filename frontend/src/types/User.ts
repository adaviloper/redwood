export type Permission = {
  name: string;
  value: boolean;
};

export type User = {
  name: string;
  email: string;
  username: string;
  permissions: Permission[];
}
