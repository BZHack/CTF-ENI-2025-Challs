from Crypto.Cipher import ARC4

key = b'635718315811252'
message = bytes.fromhex("221c6263cf96c0538b32ca638ae0d368a4cd54a84d19")
decipher = ARC4.new(key)
decrypt = decipher.decrypt(message)

print(decrypt)
