/**
 * Check if object is empty.
 */
export function isObjectEmpty(obj: Record<string, any>): boolean {
  return Object.keys(obj).length === 0
}
