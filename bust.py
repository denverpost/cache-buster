#!/usr/bin/env python
# Request fast.ly purge cache on certain URLs
import httplib2
import sys, os
import doctest

class Bust:
    """ Send a request to invalidate the cache.
        """

    def init(self):
        self.h = httplib2.Http('')

    def bust(self, url)
        url = url.strip()
        if 'http' not in url or len(url) > 1000:
            return False

        try:
            response, content = self.h.request(url, 'PURGE', headers={}, body='')
        except:
            print "ERROR: Could not bust cache on %s" % url

        return True

def main(args):
    """
        """
    b = Bust()
    for bust in args.busts[0]:
        if 'http' in bust:
            b.bust(bust)
        else:
            fh = open(bust.strip())
            for line in fh:
                print line
    
def build_parser(args):
    """ This method allows us to test the args.
        >>> parser = build_parser(['-v'])
        >>> print args.verbose
        True
        """
    parser = argparse.ArgumentParser(usage='$ python bust.py',
                                     description='Request that fast.ly purge cache on certain URLs',
                                     epilog='')
    parser.add_argument("-v", "--verbose", dest="verbose", default=False, action="store_true",
                        help="Run doctests, display more info.")
    parser.add_argument("busts", action="append", nargs="*")
    args = parser.parse_args(args)
    return args

if __name__ == '__main__':
    args = build_parser(sys.argv[1:])

    if args.verbose == True:
        doctest.testmod(verbose=args.verbose)
    main(args)
